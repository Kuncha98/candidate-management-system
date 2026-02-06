# Candidate Management System

A simple **Candidate Management System** built with **CodeIgniter 4** and **Bootstrap 5**.

## Features

- **Manual Authentication** for Admin, User, and Candidate roles
- **Admin Dashboard**: Manage users, view all candidates
- **User Dashboard**: Browse candidates, apply search and filter options
- **Candidate Dashboard**: Self-registration, profile update
- **Admin Management**: Admin can add skills and manage candidate workflows
- **Candidate Profile**: View and update candidate details
- **Advanced Search and Filtering**: Filter candidates by skills, location, experience, etc.
- **Candidate Workflow**: Candidates move through an applied → shortlisted → interview → selected pipeline
- **Secure Route Filters**: Role-based access control for routes and pages

## Tech Stack

- **Backend**: CodeIgniter 4
- **Frontend**: Bootstrap 5
- **Database**: MySQL
- **PHP**: PHP 8+

## Setup Instructions

Follow the steps below to set up and run the project locally.

### Prerequisites

Before you start, make sure you have the following installed:

- **PHP 8+**
- **Composer** for dependency management
- **MySQL** for the database

### Installation

1. Clone the repository:

   git clone <repo-url>
   cd project-folder

2. Install the dependencies using Composer:

   composer install

3. Set up environment configuration:

   cp env.example .env

4. Generate the application key:

   php spark key:generate

5. Run the migrations to create the necessary database tables:

   php spark migrate

6. Seed the database with initial data (e.g., Admin, Statuses):

   php spark db:seed AdminSeeder
   php spark db:seed StatusSeeder

7. Start the development server:

   php spark serve

### Accessing the Application

Once the server is running, you can access the application by navigating to:

```
http://localhost:8080
```

### License

This project is open-source and available under the MIT License. See the [LICENSE](LICENSE) file for more details.