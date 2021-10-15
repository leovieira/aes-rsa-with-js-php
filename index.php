<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>aes-rsa</title>

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css"
      integrity="sha512-GQGU0fMMi238uA+a/bdWJfpUGKUkBdgfFdgBm72SUQ6BeyWjoY/ton0tEjH+OSH9iP4Dfh+7HM0I9f5eR0L/4w=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="style.css" />

    <script src="https://unpkg.com/feather-icons"></script>
  </head>

  <body>
    <form onsubmit="event.preventDefault(); return false;" novalidate>
      <fieldset>
        <legend class="h2">Contact</legend>

        <div class="row">
          <div class="col">
            <label for="first_name" class="form-label">FIRST NAME *</label>
            <input
              type="text"
              id="first-name"
              class="form-control"
              placeholder="Leonardo"
            />
          </div>

          <div class="col">
            <label for="last_name" class="form-label">LAST NAME *</label>
            <input
              type="text"
              id="last-name"
              class="form-control"
              placeholder="Vieira"
            />
          </div>
        </div>

        <div class="row">
          <div class="col">
            <label for="email" class="form-label">EMAIL ADDRESS *</label>
            <input
              type="email"
              id="email"
              class="form-control"
              placeholder="contact@leovieira.dev"
            />
          </div>
        </div>

        <div class="row">
          <div class="col">
            <label for="phone" class="form-label">PHONE NUMBER *</label>
            <input
              type="tel"
              id="phone"
              class="form-control"
              placeholder="+55 (00) 00000-0000"
            />
          </div>
        </div>

        <div class="row">
          <div class="col">
            <label for="message" class="form-label">MESSAGE (OPTIONAL)</label>
            <textarea
              rows="3"
              id="message"
              class="form-control"
              placeholder="Think different."
            ></textarea>
          </div>
        </div>

        <div class="row">
          <div class="col">
            <button type="submit" onclick="submitForm();" id="btn-submit">
              Send now
              <i data-feather="arrow-right" class="arrow"></i>
            </button>
          </div>
        </div>

        <div class="row">
          <div class="col">
            <p id="response" class="response">
              Developed by <a href="https://leovieira.dev" target="_blank">leovieira.dev</a>
            </p>
          </div>
        </div>
      </fieldset>
    </form>

    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
      integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
    <script
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"
    integrity="sha512-pax4MlgXjHEPfCwcJLQhigY7+N8rt6bVvWLFyUMuxShv170X53TRzGPmPkZmGBhk+jikR8WBM4yl7A9WMHHqvg=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"
      integrity="sha512-E8QSvWZ0eCLGk4km3hxSsNmGWbLtSCSUcewDQPQWZF6pEU8GlT8a5fF32wOl1i8ftdMhssTrF/OhyGWwonTcXA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/jsencrypt/3.2.1/jsencrypt.min.js"
      integrity="sha512-hI8jEOQLtyzkIiWVygLAcKPradIhgXQUl8I3lk2FUmZ8sZNbSSdHHrWo5mrmsW1Aex+oFZ+UUK7EJTVwyjiFLA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
    <script src="script.js"></script>
  </body>
</html>
