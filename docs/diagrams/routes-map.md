
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

Review routes require authentication. All authenticated users, including admins, can create reviews. Users can only edit or delete reviews that they own.

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
