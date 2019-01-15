# Who Am I? Backend

**Version: 0.1-INDEV**

This is the backend to the [Who Am I? App](/tobiasholler/whoami-app)

## Reqirements

- MySQL or MariaDB Database

## Installing
**Commandline:**
```
cp .env.example .env
# Open and edit .env
composer install
php artisan key:generate
php artisan migrate
```

## API-Docs
**This API-Docs is not right yet. Please check the PHP software tests for examples.**

### New Game

`POST /api/new`

Creates a new multiplayer game and returns the game id. After that, the player has still to join the game.

**Request Body**
```json
{}
```

**Response Body**
```json
{
  "game_id":  "SbC2MRK69QzwN2Pq",  // Game ID (string) for further operations
}
```

### Join a existing game

`POST /join/:game_id`
`POST /join/:game_id`

Creates a new multiplayer game and returns the game id.

**Example Request Body**
```json
{
  "name": "Max",   // Name/Nickname of the player to be shown to other players
  "word": "Barack Obama",
  "description": "US-President",
  "link": "https://en.wikipedia.org/wiki/Barack_Obama"
}
```

**Example Response Body**
```json
{
  "error_code": null,   // Error Code (null|int), successful if error_code is null
  "players": {
    "Lisa": {
      "word": "Nelson Mandela",
      "description": "South African President",
      "link": "https://en.wikipedia.org/wiki/Nelson_Mandela"
    },
    "Toby": {
      "word": "Steve Jobs",
      "description": "Apple Founder",
      "link": "https://en.wikipedia.org/wiki/Steve_Jobs"
    }
  }
}
```

### Join a existing game

`GET /version`

Returns the server version.

**Example Request Body**
```json
{}
```

**Example Response Body**
```json
{
  "version": "1.0"   // string
}
```
