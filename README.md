# 🎬 CineTrack
## Movie Review & Watchlist System

**3004ICT – Major Web Application Project**

---

## Student Information

**Name:** Yuehui Chen  
**Student Number:** S5361257  
**Workshop:** Online

---

## 📖 Project Purpose

> This app helps movie enthusiasts discover, organise, and review movies they have watched or want to watch.

---

## ✨ Features

### Core Features
- User registration, login, and logout
- Display the logged-in user's name on every page
- Browse movie collection
- Create, read, update, and delete movie reviews
- Personal watchlist
- Server-side validation
- Ownership authorization

### Planned Advanced Features
- 🎬 Movie poster image upload
- 🔍 Search with pagination
- 🏷️ Movie genres (Many-to-Many relationship)
- 👤 User roles (Admin & User)
- ⚡ AJAX watchlist updates
- 🌐 Movie API integration (OMDb or TMDb)
- ✅ Laravel Feature Tests

---

## 🛠️ Technologies

- PHP 8+
- Laravel
- SQLite
- Blade
- HTML5
- CSS3
- Bootstrap
- Eloquent ORM

---

## 🗄️ Planned Database Design

| Table | Description |
|--------|-------------|
| users | User accounts |
| movies | Movie information |
| reviews | User reviews and ratings |
| genres | Movie genres |
| watchlists | User watchlists |
| genre_movie | Pivot table linking movies and genres |

---

## 🚀 Planned Functionality

### User
- Register/Login/Logout
- Browse movies
- Search movies
- Add movies to watchlist
- Write reviews
- Edit/Delete own reviews
- Upload movie posters (if permitted)

### Administrator
- Manage movies
- Manage genres
- Manage users
- Moderate reviews

---

## 📁 Project Structure

```
app/
bootstrap/
config/
database/
public/
resources/
routes/
storage/
tests/
```

---

## 📅 Development Checklist

- [ ] Project setup
- [ ] Authentication
- [ ] Database migrations
- [ ] Models & relationships
- [ ] CRUD functionality
- [ ] Validation
- [ ] Authorization
- [ ] Image upload
- [ ] Search & pagination
- [ ] Roles & middleware
- [ ] AJAX functionality
- [ ] API integration
- [ ] Feature testing
- [ ] Final testing & deployment

---

## 📚 Learning Outcomes

This project demonstrates:

- Laravel MVC architecture
- Authentication
- Relational database design
- Eloquent ORM relationships
- CRUD operations
- Validation
- Authorization
- Middleware
- File uploads
- Search & pagination
- Third-party API integration
- Automated feature testing

---

## 📄 License

This project was developed for the **3004ICT Web Application Development** course at **Griffith University**.

This repository is intended for educational purposes only.