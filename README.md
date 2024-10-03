
# Batu Grades Laravel

Batu Grades is a Laravel application designed to manage student grades through CSV file uploads. The application allows users to upload CSV files, convert the data into JSON format, and retrieve grades based on sitting numbers.

## Features

- **Department Selection**: Choose from various academic departments.
- **CSV File Upload**: Upload CSV files containing student grades.
- **Grade Management**: View grades by sitting number.
- **JSON Conversion**: Automatically converts uploaded CSV data into JSON format for easier retrieval.

## Home Page

![Home Page](https://github.com/Ziad-Abaza/batu-grades-laravel/blob/main/public/batu-grade.jpeg)

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/Ziad-Abaza/batu-grades-laravel.git
   ```

2. Navigate to the project directory:
   ```bash
   cd batu-grades-laravel
   ```

3. Install dependencies:
   ```bash
   composer install
   ```

4. Set up your `.env` file:
   ```bash
   cp .env.example .env
   ```

5. Generate the application key:
   ```bash
   php artisan key:generate
   ```

6. Run migrations (if any):
   ```bash
   php artisan migrate
   ```

7. Start the local development server:
   ```bash
   php artisan serve
   ```

## Usage

1. Navigate to the home page to select a department.
2. Upload a CSV file containing student grades.
3. View the grades by entering the sitting number.

## Code Overview

### GradesController

This controller manages the logic for displaying departments, uploading CSV files, converting CSV data to JSON, and retrieving grades.

#### Key Methods:

- `index(Request $request)`: Displays the home page with department options.
- `upload()`: Shows the upload page.
- `store(Request $request)`: Validates and stores the uploaded CSV file.
- `show(Request $request)`: Validates and retrieves student grades based on the sitting number.

### Routes

The application uses the following routes to handle requests:

```php
Route::controller(GradesController::class)->group(function(){
    Route::get('/', [GradesController::class, 'index']);
    Route::get('/upload', [GradesController::class, 'upload']);
    Route::post('/pages.upload', [GradesController::class, 'store'])->name('store.file');
    Route::post('/pages.grades', [GradesController::class, 'show'])->name('view.grades');
});
```


