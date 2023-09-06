<h1>NLET</h1>


# Candidate Management APIs

This repository contains a set of APIs for managing candidates. These APIs allow you to perform various operations related to candidates, including registration, login, candidate creation, searching, and listing.

## API Endpoints

### Register a New Admin (POST)

- Endpoint: `/api/auth/register`
- Description: Register a new admin with a unique email and password.
- Request:
  - `name` (string, required): The name of the admin.
  - `email` (string, required): The admin's email address.
  - `password` (string, required): The admin's password.
  - `secret_key` (string, required): The admin's Registration Secret Key.
- Response: Successfully registered admin.

### Admin Login (POST)

- Endpoint: `/api/auth/login`
- Description: Authenticate an admin and obtain a JWT token for further API access.
- Request:
  - `email` (string, required): The admin's email address.
  - `password` (string, required): The admin's password.
- Response: A JSON response containing an access token.

### Admin Profile (GET)

- Endpoint: `/api/auth/profile`
- Description: Retrieve the profile of the authenticated admin using the JWT token.
- Response: A JSON response with admin profile data.

### Admin Logout (GET)

- Endpoint: `/api/auth/logout`
- Description: Log out the authenticated admin and invalidate the JWT token.
- Response: A JSON response confirming the successful logout.


### Create Candidate (POST)

- Endpoint: `/api/auth/candidate`
- Description: Create a new candidate record.
- Request:
  - `first_name` (string, required): The first name of the candidate.
  - `last_name` (string, optional): The last name of the candidate.
  - `email` (string, required): The candidate's email address.
  - `contact_number` (string, required): The candidate's contact number.
  - `gender` (integer, required): The candidate's gender (1 for Male, 2 for Female).
  - `qualification_specialization` (string, optional): The candidate's qualification specialization.
  - `total_experience` (integer, optional): The candidate's total experience in years.
  - `birthdate_unix` (integer, optional): The candidate's birth date in Unix Timestamp (Epoch).
  - `full_address` (string, optional): The candidate's full address.
  - `resume_file` (file, optional): The candidate's resume file (PDF, DOC, or DOCX format).
- Response: A JSON response confirming the successful creation of a candidate.

### Find Candidate by ID (GET)

- Endpoint: `/api/auth/candidates/{id}`
- Description: Retrieve a candidate by their unique ID.
- Response: A JSON response with candidate data or an error message if not found.

### List Candidates (GET)

- Endpoint: `/api/auth/candidates`
- Description: List all candidates with pagination.
- Request:
  - `limit` (integer, optional): The number of candidates to show per page (default: 25).
- Response: A JSON response with paginated candidate data.

### Search Candidates by Name (GET)

- Endpoint: `/api/auth/candidates/search/{name}`
- Description: Search for candidates by name.
- Response: A JSON response containing a list of matching candidates or an error message if not found.



## Installation and Usage

To use these APIs, follow these steps:

1. Clone the repository.
2. Install the required dependencies using `composer install`.
3. Set up your database configuration in `.env`.
4. Migrate the database using `php artisan migrate`.
5. Start the Laravel development server using `php artisan serve`.
6. Access the APIs using your preferred API client (e.g., Postman).

Ensure that you have the necessary authentication details (e.g., JWT token) for authenticated endpoints.

Please refer to the individual API endpoints for detailed request and response formats.

Happy coding!
