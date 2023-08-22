# Contact Form with PHP Validation

Welcome to the Contact Form project! This repository contains a contact form implemented using PHP that provides validation for input fields, avoids duplicate submissions, and sends email notifications to the site owner upon form submission.

## Features

- Validates each input field to ensure correct and valid user input using PHP.
- Retains filled input fields even when errors are displayed.
- Prevents duplicate form submissions when the page is refreshed.
- Sends an email notification to the site owner containing the form submission details.
- Includes SQL database integration for storing form submissions.

## Setup Instructions

1. Clone or download this repository to your local machine.

2. **Database Setup:**
   - Create a MySQL database named `contactform`.
   - Import the SQL file (`contactform.sql`) from the project into the `contactform` database. This will create the necessary table for storing form submissions.

3. **Web Server Setup:**
   - Place the project folder in the `htdocs` directory of your XAMPP installation.

4. **Configuration:**
   - Open the `config.php` file and update the database connection details (host, username, password) to match your MySQL server configuration.

5. **Email Configuration:**
   - Open the `contact.php` file and set the appropriate email address in the `$to` variable. This is where email notifications will be sent.

6. **Running the Project:**
   - Start your XAMPP server and make sure MySQL and Apache are running.
   - Access the project by navigating to `http://localhost/project-folder` in your web browser.

## Usage

1. Access the contact form by visiting the project URL in your browser.

2. Fill out the form with the required information, making sure to provide valid input for each field.

3. Upon submission, the form will validate the input and display any errors that may occur.

4. If the form submission is successful, an email notification will be sent to the site owner with the submission details.

## Contributing

Contributions are welcome! If you find any issues or improvements, please feel free to submit a pull request or open an issue.

## License

This project is licensed under the [MIT License](LICENSE).

---

Thank you for using the Contact Form with PHP Validation project. If you have any questions or need assistance, please don't hesitate to contact us.
# contact-form
