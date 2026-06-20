# Riot Records — Paramore Archive

> 📚 A project submission for **Web Development 2**

A fan archive web app for Paramore, featuring artist info, discography, tracks, a merch store, an interactive quiz, and a community comment section.

## Tech Stack

- **Backend:** PHP (vanilla, no framework)
- **Database:** MySQL via `mysqli`
- **Frontend:** Tailwind CSS (CDN), Google Fonts (Exo, Jersey 10)
- **Dependencies:** [`vlucas/phpdotenv`](https://github.com/vlucas/phpdotenv) for environment variable management

## Features

- 🎵 **Dashboard** — Artist bio, band members, and timeline pulled from the Last.fm API
- 💿 **Discography** — Browse all releases and individual album pages with tracklists
- 🎶 **Tracks** — Full track listings per album
- 💬 **Comments** — Full CRUD comment section (create, read, edit, delete)
- 🛍️ **Store** — Merch/product listings
- 🧠 **Quiz** — Paramore trivia quiz with randomly generated questions
- 🔐 **Auth** — User registration and login with PHP sessions

## Setup

### Requirements

- PHP 8+
- MySQL
- Composer

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/your-username/Riot-Records.git
   cd Riot-Records
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Configure environment variables**

   Create a `.env` file in the project root:
   ```env
   DB_HOST=localhost
   DB_USER=root
   DB_PASS=your_password
   DB_NAME=paramore
   DB_PORT=3306

   artist=Paramore
   userName=your_lastfm_username

   OPENAI_API_KEY=your_openai_api_key
   ```

4. **Set up the database**

   Create a MySQL database named `paramore` and import your schema.

5. **Run the app**

   Serve the project with a local PHP server or a tool like XAMPP/Laragon:
   ```bash
   php -S localhost:8000
   ```
   Then open [http://localhost:8000](http://localhost:8000) in your browser.

## Project Structure

```
Riot-Records/
├── php/
│   ├── CRUD/               # Database operations (login, register, comments, products)
│   ├── config.php          # Loads .env variables
│   ├── getArtist.php       # Fetches artist data from Last.fm API
│   ├── getAlbum.php        # Fetches album data
│   ├── generateQuestion.php# Quiz question generation
│   └── hardCodedInfo.php   # Static artist/band info
├── assets/                 # Images and static assets
├── index.php               # Landing page
├── dashboard.php           # Main hub
├── album.php               # Album detail page
├── allReleases.php         # Full discography
├── tracks.php              # Track listings
├── comments.php            # Community comments
├── store.php               # Merch store
├── quiz.php                # Trivia quiz
├── login.php               # Login page
└── register.php            # Registration page
```
