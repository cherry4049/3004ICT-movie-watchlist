
# CineTrack — Entity Relationship Diagram

## Database purpose

CineTrack uses a relational database to store movies, user reviews, genres, and the relationships between users and their reviews.

## ERD

![ERD](..\..\public\images/ERD.png)

## Tables

### users

- id (PK)
- name
- email
- password
- role

### movies

- id (PK)
- title
- description
- release_year
- poster

### reviews

- id (PK)
- user_id (FK → users.id)
- movie_id (FK → movies.id)
- rating
- title
- content

### genres

- id (PK)
- name

### movie_genre

- id (PK)
- movie_id (FK → movies.id)
- genre_id (FK → genres.id)

## Relationships

- User has many Reviews.
- Review belongs to User.
- Movie has many Reviews.
- Review belongs to Movie.
- Movie belongs to many Genres.
- Genre belongs to many Movies.
- Movie and Genre are connected through `movie_genre`.

## Business rules

- A review belongs to the authenticated user who created it.
- A user can review a movie only once.
- A review rating must be between 1 and 5.
- Movie and genre references must exist.
