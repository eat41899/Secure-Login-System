# Secure-Login-System LAMP stack

1. Preparing the web server

Prepare a web server on the latest stable version of Ubuntu Linux distribution. 
Required to install LAMP (Linux, Apache, MySQL, PHP stack) on Ubuntu with necessary configurations 
Write an automation script (a language of your choice) to automate the installation and configuration of
your server for disaster recovery purposes with comments for every single command:
installation.{sh,py,rb,pl,...}: It will include all the commands regarding installation of all the necessary services and
tools. Also, the script contains all configuration steps for LAMP.

2. The webpage

A login page, and upon successfully logging into the system, it will allow the user to download the company_confidential_file.txt. 
The database containing information about the user should be implemented in MySQL.

1) The login page
An "https" webpage redirected from localhost would be a simple login page where the user can enter the username
and password and a “Login” button. Also, available on that page are two links: (i) New User? Sign Up and (ii)
Forgot Username or Password?.
2) New user sign up
New user sign up page must have at minimum the following features, yet you may add more features to
increase the security of your authentication system.
- Typical information about the user: First Name, Last Name, Birth date, E-mail.
- User's password: Password and re-enter password along with real-time proactive password metric feedback (i.e., is
this password weak, strong, etc.). You will decide what the required password selection rule should be.
- Some type of challenge-response test to determine whether or not the user is human (e.g., CAPTCHA and
reCAPTCHA).
- Activation of account via e-mail.
- A set of security questions for password retrieval.
3) Forgot username and password
Logging:
Log appropriately when suspicious activities (e.g., suspected online password guessing) or attacks are
detected. Also, your implementation is required to log all of successful and unsuccessful login attempts.
Defensive Programming:

And lastly, you should address the following attacks in your design and implementation, if they are relevant:
1) Brute force
2) SQL Injection
3) Buffer Overflow
4) XSS
5) Cross Site Request Forgery
