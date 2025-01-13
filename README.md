# Registration System

## Project Overview

This project is a simple PHP-based registration system that allows users to input their information, which is then stored in a JSON file. Users can search for or view existing records and check for duplicate entries.

## Files and Their Functions

- **`data.json`**:  
  Stores the user registration data in JSON format.  
  Each entry contains the following fields:
  - `name`
  - `father_name`
  - `phone`
  - `email`
  - `address`
  - `passport_picture` (URL of the passport picture)
  
- **`register.php`**:  
  Handles the registration form submission and stores user data in `data.json`.  
  Features include:
  - Duplicate check to prevent duplicate entries.
  - Success message on new registrations.
  - Error message if the information already exists.

- **`result.php`**:  
  Displays user information based on search or retrieval criteria.

- **`index.php`**:  
  The main search page where users can search for registered information by entering specific criteria.

## How It Works

1. **User Registration**:
   - Navigate to `register.php` to fill out the registration form.
   - If the same information already exists, the system will show an error with the existing record's ID.
   - If the information is unique, a new entry is created in `data.json`, and a success message is displayed.

2. **Data Storage**:
   - All user information is stored in `data.json` as a JSON object.
   - Each record is associated with a unique ID.

3. **Search Functionality**:
   - Use `index.php` to search for registered information.
   - The `result.php` page displays the search results.

## Installation and Setup

1. Clone the repository:
   ```bash
   git clone https://github.com/MrTusarRX/data-info-register.git
   cd data-info-register
