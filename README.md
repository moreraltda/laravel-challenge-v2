# File Collaboration Platform

This is a simple file collaboration platform built with Laravel and Inertia.js.

## Features

- Users can create, read, update, and delete files.
- Users can share files with other users.
- Users can view the details of a file, including the owner and the users who have access to it.

## Installation

1. Clone the repository
2. Install Docker
3. Run `composer install`
4. Run `vendor/bin/sail up`
5. Run `vendor/bin/sail artisan migrate --seed`
6. Run `npm install`
7. Run `npm run dev`
8. Run `vendor/bin/sail artisan reverb:start`
8. Enjoy project from `http://localhost`

## Usage

1. Login with `admin@example.com` and password `password` at `http://localhost/login`
2. Go to file section
3. Perform CRUD operations
4. Share the file with other users (optional)
5. View changes in real time in the file section, broadcasted event by Reverb and Laravel Echo
