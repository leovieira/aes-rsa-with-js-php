$(document).ready(() => {
	feather.replace();
});

function showActivityIndicator() {
	var btn = $("#btn-submit");

	btn.attr("disabled", true);
	btn.text("Sending");
	btn.append("<i data-feather='loader' class='loader'></i>");

	feather.replace();
}

function hideActivityIndicator() {
	var btn = $("#btn-submit");

	btn.attr("disabled", false);
	btn.text("Send now");
	btn.append("<i data-feather='arrow-right' class='arrow'></i>");

	feather.replace();
}

function resetMessage() {
	var el = $("#response");

	el.removeClass("success");
	el.removeClass("error");
	el.text("");
}

function showMessage(type, msg) {
	var el = $("#response");

	resetMessage();

	el.addClass(type);
	el.text(msg);
}

function resetForm() {
	$("#first-name").val("");
	$("#last-name").val("");
	$("#email").val("");
	$("#phone").val("");
	$("#message").val("");
}

async function getPublicKey() {
	try {
		const response = await $.ajax({
			type: "get",
			url: "get_public_key.php",
		});

		if (response.error === false) {
			return response.public_key;
		} else {
			throw response.msg;
		}
	} catch {
		throw "Failed to fetch public key.";
	}
}

async function encryptData(data) {
	try {
		/*
			The Advanced Encryption Standard (AES) has three key sizes: 128, 192 or 256 bits.
			For this example a key with a size of 256 bits (32 bytes) was used.
			The AES cryptographic system uses fixed blocks of 128 bits,
			so the initialization vector (IV) must have the same size as its block,
			128 bits (16 bytes).
		*/
		var aes_key = CryptoJS.lib.WordArray.random(32);
		var aes_iv = CryptoJS.lib.WordArray.random(16);

		var dataEnc = CryptoJS.AES.encrypt(data, aes_key, {
			iv: aes_iv,
		});

		var dataEncBase64 = CryptoJS.enc.Base64.stringify(dataEnc.ciphertext);

		var aes_key_hex = CryptoJS.enc.Hex.stringify(aes_key);
		var aes_iv_hex = CryptoJS.enc.Hex.stringify(aes_iv);

		console.log("encrypted data: " + dataEncBase64);
		console.log("aes key: " + aes_key_hex);
		console.log("aes iv: " + aes_iv_hex);

		var public_key = await getPublicKey();
		console.log("public key: " + public_key);

		encrypt = new JSEncrypt();
		encrypt.setPublicKey(public_key);

		var aes_key_enc = encrypt.encrypt(aes_key_hex);
		console.log("aes key encrypted: " + aes_key_enc);

		return {
			data: dataEncBase64,
			key: aes_key_enc,
			iv: aes_iv_hex,
		};
	} catch {
		throw "Failed to encrypt data.";
	}
}

async function sendData(data) {
	try {
		const response = await $.ajax({
			type: "post",
			url: "process_form.php",
			data: data,
			dataType: "json",
			processData: false,
			contentType: "application/json; charset=UTF-8",
		});

		if (response.error === false) {
			return response.data;
		} else {
			throw response.msg;
		}
	} catch {
		throw "Failed to send data.";
	}
}

async function submitForm() {
	try {
		showActivityIndicator();

		const firstName = $("#first-name").val().trim();
		const lastName = $("#last-name").val().trim();
		const email = $("#email").val().trim();
		const phone = $("#phone").val().trim();
		const message = $("#message").val().trim();

		if (firstName != "" && lastName != "" && email != "" && phone != "") {
			const formData = {
				fname: firstName,
				lname: lastName,
				email: email,
				phone: phone,
				message: message,
			};

			var formDataJson = JSON.stringify(formData);
			console.log("form data: " + formDataJson);

			var requestData = await encryptData(formDataJson);
			var requestDataJson = JSON.stringify(requestData);

			var responseData = await sendData(requestDataJson);
			console.log("decrypted data: " + JSON.stringify(responseData));

			showMessage("success", "Message sent successfully!");
			resetForm();
		} else {
			showMessage("error", "Fields with (*) are required.");
		}
	} catch {
		showMessage("error", "Oops... Something went wrong!");
	} finally {
		hideActivityIndicator();
	}
}
