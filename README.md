
# CineTrack

## Movie Review System

**3004ICT – Web Application Development Project**

---

## Student Information

**Name:** Yuehui Chen
**Student Number:** S5361257
**Workshop:** Online

---

## Project Purpose

> CineTrack helps movie fans discover movies, read reviews, and create and manage their own movie reviews.

---

## Features

### Core Features

* User registration, login, and logout
* Display the logged-in user's name
* Browse the movie collection
* View movie details and ratings
* Create, read, update, and delete movie reviews
* Server-side validation
* Ownership authorisation

### Additional Features

* Movie poster image upload
* Movie search with pagination
* Movie genres using a many-to-many relationship
* User roles (Admin & User)
* Admin authorisation using middleware
* TMDB movie search and poster integration

---

## Technologies

* PHP 8+
* Laravel 13
* SQLite
* Blade
* HTML5
* Tailwind CSS
* JavaScript
* Eloquent ORM
* TMDB API

---

## Database Design

| Table       | Description                            |
| ----------- | -------------------------------------- |
| users       | Registered user accounts and roles     |
| movies      | Movie information and poster filenames |
| reviews     | User reviews and ratings for movies    |
| genres      | Available movie genres                 |
| movie_genre | Pivot table linking movies and genres  |

### Relationships

* A user can create many reviews.
* A movie can have many reviews.
* A review belongs to one user and one movie.
* A movie can have many genres.
* A genre can belong to many movies through the `movie_genre` pivot table.

---

## Functionality

### Guest Users

* View the CineTrack home page
* Browse movies
* Search and filter movies
* View movie details
* View movie ratings and reviews
* Register for an account
* Log in

### Registered Users

* All guest functionality
* Write reviews for movies
* Edit their own reviews
* Delete their own reviews
* View their own reviews
* User ownership authorisation prevents editing or deleting other users' reviews

### Administrators

* Manage movies
* Add new movies
* Edit movies
* Delete movies
* Upload and replace movie posters
* Select multiple movie genres
* Search TMDB for movie information
* Populate the Add Movie form using TMDB results
* Download selected TMDB posters into the CineTrack application
* Admin-only movie management protected by authentication and admin middleware

---

## TMDB Integration

CineTrack integrates with the **TMDB API** to help administrators add movie information.

The workflow is:

```text
Admin → Add Movie
        ↓
Search TMDB
        ↓
Select a movie
        ↓
Movie information populates the Add Movie form
        ↓
Admin reviews/edits the information
        ↓
Save movie to CineTrack
```

TMDB movie information includes the movie title, description, release year, genres, and poster information.

TMDB posters are downloaded and stored locally in:

```text
public/images/
```

The TMDB API Read Access Token is stored in the local `.env` file and is not committed to the repository.

---

## Movie Posters

Administrators can upload movie posters using the Add Movie and Edit Movie forms.

Supported formats:

* JPEG
* PNG
* GIF

Maximum file size:

* 2 MB

When an existing movie poster is replaced, the old poster file is removed from the `public/images/` directory. Deleting a movie also removes its associated poster file.

---

## Search, Filtering & Pagination

The Browse Movies page supports:

* Movie title search
* Genre filtering
* Release year filtering
* Pagination

Movies are displayed six per page, and search/filter values are preserved when moving between pages.

---

## Authentication & Authorisation

CineTrack uses Laravel authentication for registered users.

Two user roles are supported:

* **User**
* **Admin**

Administrative movie management routes require both authentication and the admin role.

Review ownership is also enforced so users can only edit or delete their own reviews.

---

## Design & Interface Implementation

Wireframes were created during the planning stage and used to guide the implementation of the application's interfaces and screen layouts.

During development, the interfaces were refined where necessary to improve usability, consistency, responsiveness, and the overall flow of the application. These improvements were made while implementing the planned screens so that the final interface remained consistent with the original design while responding to practical implementation requirements.

---

## Project Structure

```text
app/
├── Http/
│   ├── Controllers/
│   └── Middleware/
├── Models/
└── Services/

bootstrap/
config/
database/
public/
├── images/
resources/
├── css/
└── views/
routes/
storage/
├── certs/
└── ...
tests/
```

---

## Development Status

* [X] Project setup
* [X] Authentication
* [X] Database migrations
* [X] Models and relationships
* [X] CRUD functionality
* [X] Server-side validation
* [X] Authorisation
* [X] Movie poster upload
* [X] Search and pagination
* [X] Movie genres and many-to-many relationship
* [X] User roles and middleware
* [X] TMDB API integration
* [X] TMDB poster download
* [X] Poster file cleanup

---

## Learning Outcomes

This project demonstrates:

* Laravel MVC architecture
* Authentication
* Relational database design
* Eloquent ORM relationships
* CRUD operations
* Server-side validation
* Authorisation
* Middleware
* File uploads
* Search, filtering and pagination
* Many-to-many relationships
* User roles
* Third-party API integration
* Integration of external API data into an existing application workflow

---

## License

This project was developed for the **3004ICT Web Application Development** course at **Griffith University**.

This repository is intended for educational purposes only.
