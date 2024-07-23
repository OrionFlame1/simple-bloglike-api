# simple-bloglike-api

<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
      <ul>
        <li><a href="#built-with">Built With</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
    </li>
    <li>
      <a href="#usage">Usage</a>
      <ul>
        <li><a href="#get-routes">GET Routes</a></li>
        <li><a href="#post-routes">POST Routes</a></li>
      </ul>
    </li>
    <li><a href="#roadmap">Roadmap</a></li>
  </ol>
</details>

## About The Project

This project served as the API for a college project, where storing and reading data from a database were needed. It was made in a very simple way, for simple CRUD operations. It is written in PHP and it needs a MySQL Database server.

### Built With

[![PHP][php-shield]][php-url]
<br/>
[![MySQL][mysql-shield]][mysql-url]

<!-- GETTING STARTED -->
## Getting Started

To get started, you can clone the repo (recommended) or download as archive. To clone the repo use:
```bash
  git clone https://github.com/OrionFlame1/simple-bloglike-api
```

### Deployment
You can deploy this api by using Docker (recommended) or manually.

#### Docker

1. Open a command prompt/terminal
2. Change to directory of the repo using ```cd simple-bloglike-api```
3. Build the container and start using ```docker compose up --build```

#### Manually
1. Drop the repo on the root of a webserver supporting PHP with a MySQL instance running
2. Run the install.sql file to create the structure of the database
3. (Optional) Run the example.sql file to populate the database with a few example rows I used for testing the API.

<!-- USAGE EXAMPLES -->
## Usage

Make a simple request to the host and add the name of the route and the parameters required. All routes return a response in JSON format. All the required data is sent as a query parameter in the URL.

You can use the query parameter `format=true` to any `GET` route to receive a pre-rendered response (usually used for testing purposes)

### GET Routes

`/getPosts`

Returns all posts as an array, sorted by date (descending). If there are no posts to return, an empty array will be returned instead. <br>
Expected Output:
```json
[
    {
        "id": "5",
        "title": "Big Title",
        "content": "help",
        "posted_at": "2024-05-03 13:57:31",
        "username": "john_doe"
    },
    {
        "id": "4",
        "title": "Literature Analysis Assistance",
        "content": "Require help analyzing a poem by Emily Dickinson for my English class.",
        "posted_at": "2024-04-13 16:20:00",
        "username": "john_doe"
    }
]
```

<br>

`/getPost?post_id={id}`

<mark>required parameter:</mark> post_id -> (int) id

Returns information about a specific post using the `post_id` parameter value. The comments for the same post are included in the response as an array named `comments`.<br>
Expected Output (replace {id} from route name with an existent id for a post from the database):
```json
{
    "id": "5",
    "title": "Big Title",
    "content": "help",
    "posted_at": "2024-05-03 13:57:31",
    "username": "john_doe",
    "comments": [
        [
            "mike_jones",
            "short comment",
            "2024-05-03 14:35:27"
        ]
    ]
}
```

### POST Routes

`/login?username={username}&password={password}`

<mark>required parameters stored in <b>URL</b>:</mark>
<ul>
  <li>(string) username - name of the account</li>
  <li>(string) password - password of the account</li>
</ul>

Login to an account using the credentials given. Providing not-existing username, using a wrong password to an existing account, leaving a field empty will return an error regarding the issue. Successful login returns the id and the username of the logged account.

Examples:
#### Successful login:
```json
{
    "success": true,
    "data": {
        "id": "4",
        "username": "john_doe"
    }
}
```

#### Username not found:
```json
{
    "error": "Username not found"
}
```

#### Username found, wrong password:
```json
{
    "error": "Wrong password"
}
```

#### Password field empty:
```json
{
    "error": "Password field can't be empty"
}
```

<br>

`/register?username={username}&password={password}&email={email}`

<mark>required parameters stored in <b>URL</b>:</mark>
<ul>
  <li>(string) username - name of the account</li>
  <li>(string) password - password of the account</li>
  <li>(string) email - email address bound of the account</li>
</ul>

Register a new account using the given credentials. Returns an error if any required field is not filled, username or email are already used or the register process failed.

Examples:
#### Successful login:
```json
{
    "success": true,
    "data": {
        "id": "5",
        "username": "adi1",
        "email": "adi1@example.com",
    }
}
```

#### Username or email already registered:
```json
{
    "error": "Username or Email already registered"
}
```

#### Email field empty:
```json
{
    "error": "Email field can't be empty"
}
```

`/addPost`

<mark>required parameters stored in <b>postfields</b>:</mark>
<ul>
  <li>(int) user_id - the id of the user posting</li>
  <li>(string) title - title of the post</li>
  <li>(string) content - content of the post</li>
</ul>

Inserts a new post using the required parameters. Returns `null` always.

<br>

`/addComment`

<mark>required parameters stored in <b>postfields</b>:</mark>
<ul>
  <li>(int) user_id - the id of the user posting</li>
  <li>(int) post_id - the id of the post where the comment is being posted</li>
  <li>(string) content - content of the comment</li>
</ul>

Inserts a new comment at the specified `post_id` post using the required parameters. Returns `null` always.

<!-- ROADMAP -->
## Roadmap

- [x] Write the README.md
- [x] Add the SQL files for creating and populating the database
- [x] Add Dockerfile and docker-compose.yml for easier installation


<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->
[php-shield]: https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white
[php-url]: https://www.php.net/
[mysql-shield]: https://img.shields.io/badge/MySQL-00000F?style=for-the-badge&logo=mysql&logoColor=white
[mysql-url]: https://dev.mysql.com/doc/