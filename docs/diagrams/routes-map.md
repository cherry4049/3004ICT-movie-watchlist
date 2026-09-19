# CineTrack Routes Map

## Route Overview

The CineTrack application uses Laravel routes to control access to public, authenticated, and administrator functions.

### Public Routes

| Method | Route               | Purpose                                                      | Access |
| ------ | ------------------- | ------------------------------------------------------------ | ------ |
| GET    | `/`               | Display home page with recent movies                         | Public |
| GET    | `/register`       | Display registration form                                    | Public |
| POST   | `/register`       | Register a new user                                          | Public |
| GET    | `/login`          | Display login form                                           | Public |
| POST   | `/login`          | Authenticate a user                                          | Public |
| GET    | `/movies`         | Browse movies with search, genre, year filter and pagination | Public |
| GET    | `/movies/{movie}` | View movie details and reviews                               | Public |

### Authenticated Routes

| Method | Route                              | Purpose                              | Access                |
| ------ | ---------------------------------- | ------------------------------------ | --------------------- |
| GET    | `/my-reviews`                    | Display the logged-in user's reviews | Authenticated         |
| GET    | `/movies/{movie}/reviews/create` | Display review creation form         | Authenticated         |
| POST   | `/movies/{movie}/reviews`        | Save a new review                    | Authenticated         |
| GET    | `/reviews/{review}/edit`         | Display review edit form             | Authenticated + Owner |
| PUT    | `/reviews/{review}`              | Update an existing review            | Authenticated + Owner |
| DELETE | `/reviews/{review}`              | Delete an existing review            | Authenticated + Owner |
| POST   | `/logout`                        | Log the current user out             | Authenticated         |

### Administrator Routes

All administrator routes use both the `auth` and `admin` middleware. Only authenticated users with the `admin` role can access these routes.

| Method | Route                          | Purpose                           | Access |
| ------ | ------------------------------ | --------------------------------- | ------ |
| GET    | `/admin/movies`              | Display the movie management page | Admin  |
| GET    | `/admin/movies/create`       | Display the Add Movie form        | Admin  |
| POST   | `/admin/movies`              | Save a new movie                  | Admin  |
| GET    | `/admin/movies/{movie}/edit` | Display the Edit Movie form       | Admin  |
| PUT    | `/admin/movies/{movie}`      | Update an existing movie          | Admin  |
| DELETE | `/admin/movies/{movie}`      | Delete a movie                    | Admin  |

## TMDB Movie Search Flow

TMDB movie search is integrated into the existing administrator Add Movie workflow.

```text
Admin
  ↓
Add Movie
  ↓
Search TMDB
  ↓
Select Movie
  ↓
Movie information populates the existing form
  ↓
Admin checks/edits information
  ↓
Submit Add Movie form
  ↓
MovieController stores the movie
  ↓
TMDB poster is downloaded when selected
  ↓
Movie saved to CineTrack database
```

The TMDB search is handled through the Add Movie page using a GET request with the `tmdb_search` query parameter rather than a separate public route.

## Access Control

```text
Guest
 ├── Home
 ├── Browse Movies
 ├── View Movie Details
 ├── Register
 └── Login

Authenticated User
 ├── All public pages
 ├── My Reviews
 ├── Create Review
 ├── Edit Own Review
 ├── Delete Own Review
 └── Logout

Administrator
 ├── All authenticated functions
 └── Movie Management
      ├── View Movies
      ├── Add Movie
      ├── Search TMDB
      ├── Edit Movie
      └── Delete Movie
```

## Middleware and Authorisation

* Public movie routes allow guests to browse movies and read reviews.
* Review creation, editing, updating and deletion require authentication.
* Review editing and deletion also check that the authenticated user owns the review.
* Administrator movie management routes require both `auth` and `admin` middleware.
* The `admin` middleware checks that the authenticated user's role is `admin`.
* Unauthorised access to protected administrator or review-owner functions returns HTTP 403.
* Logout requires authentication.

## Main Route Flow

```text
Home
  ↓
Browse Movies
  ↓
Movie Details
  ├── Read Reviews
  └── Login/Register
           ↓
      Create Review
           ↓
      My Reviews
       ├── Edit Own Review
       └── Delete Own Review

Administrator
  ↓
Manage Movies
  ├── View Movie
  ├── Add Movie
  │     └── Search TMDB → Select Movie → Save
  ├── Edit Movie
  └── Delete Movie
```

## Related Controllers

| Controller           | Main Responsibility                                                          |
| -------------------- | ---------------------------------------------------------------------------- |
| `MovieController`  | Home page, public movie browsing, movie details and administrator movie CRUD |
| `ReviewController` | Review creation, display, editing, updating and deletion                     |
| `AuthController`   | Registration, login and logout                                               |

## Related Middlewar

# CineTrack — Routes Map

This document maps CineTrack's planned pages and actions to Laravel routes. The routes may be updated during implementation as the application structure develops.

## Access Levels

| Access Level       | Description                                                              |
| ------------------ | ------------------------------------------------------------------------ |
| Guest              | Anyone visiting the application without logging in                       |
| Authenticated User | A registered user who has logged in, including users with the admin role |
| Review Owner       | The authenticated user who created the review                            |
| Admin              | An authenticated user with the admin role                                |

---

## Public Routes

These routes are available to guests and authenticated users.

| Method | Route               | Page / Action                                | Access |
| ------ | ------------------- | -------------------------------------------- | ------ |
| GET    | `/`               | Home page                                    | Guest  |
| GET    | `/movies`         | Browse movies, search, filter and pagination | Guest  |
| GET    | `/movies/{movie}` | View movie details and reviews               | Guest  |

---

## Authentication Routes

| Method | Route         | Page / Action             | Access             |
| ------ | ------------- | ------------------------- | ------------------ |
| GET    | `/register` | Display registration form | Guest              |
| POST   | `/register` | Create a new user account | Guest              |
| GET    | `/login`    | Display login form        | Guest              |
| POST   | `/login`    | Authenticate user         | Guest              |
| POST   | `/logout`   | Log out the current user  | Authenticated User |

---

## Review Routes

All review routes require authentication. The edit, update and delete actions also perform a server-side ownership check in `<span>ReviewController</span>`, so users can only edit, update or delete their own reviews.

| Method    | Route                              | Page / Action                              | Access             |
| --------- | ---------------------------------- | ------------------------------------------ | ------------------ |
| GET       | `/movies/{movie}/reviews/create` | Display write review form                  | Authenticated User |
| POST      | `/movies/{movie}/reviews`        | Create a review                            | Authenticated User |
| GET       | `/reviews/{review}/edit`         | Display edit review form                   | Review Owner       |
| PUT/PATCH | `/reviews/{review}`              | Update own review                          | Review Owner       |
| DELETE    | `/reviews/{review}`              | Delete own review                          | Review Owner       |
| GET       | `/my-reviews`                    | View reviews written by the logged-in user | Authenticated User |

---

## Admin Routes

These routes require authentication and the admin role. Role middleware will block normal users from accessing these routes.

| Method    | Route                          | Page / Action                 | Access |
| --------- | ------------------------------ | ----------------------------- | ------ |
| GET       | `/admin/movies`              | Display movie management page | Admin  |
| GET       | `/admin/movies/create`       | Display add movie form        | Admin  |
| POST      | `/admin/movies`              | Create a movie                | Admin  |
| GET       | `/admin/movies/{movie}/edit` | Display edit movie form       | Admin  |
| PUT/PATCH | `/admin/movies/{movie}`      | Update a movie                | Admin  |
| DELETE    | `/admin/movies/{movie}`      | Delete a movie                | Admin  |

---

## Route Flow

```text
Guest
 │
 ├── Home (/)
 │
 ├── Browse Movies (/movies)
 │        │
 │        ├── Search / Filter / Pagination
 │        │
 │        └── Movie Details (/movies/{movie})
 │                   │
 │                   └── Read Reviews
 │
 ├── Register (/register)
 │
 └── Login (/login)
          │
          ▼
Authenticated User
 │
 ├── Browse Movies
 ├── Write Review
 ├── My Reviews
 │      ├── Edit Own Review
 │      └── Delete Own Review
 │
 └── Logout
          │
          ▼
        Admin
          │
          ├── All normal user functions
          │
          └── Admin Movie Management
                 ├── Add Movie
                 ├── Edit Movie
                 └── Delete Movie
```

## Authorisation Rules

CineTrack uses server-side authorisation to protect user-owned reviews and admin-only functionality.

* Guests can browse movies and read reviews but cannot create reviews.
* Authenticated users can create reviews and manage only their own reviews.
* Admins can also create and manage their own reviews but cannot edit or delete reviews belonging to other users.
* Users cannot edit or delete another user's review, even if they manually change the URL.
* Admin routes for movie management are protected using role middleware.
* Normal users are blocked from accessing admin movie management routes.
