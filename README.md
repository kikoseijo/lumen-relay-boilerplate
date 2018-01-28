# Lumen + Relay Modern

A GraphQL Server in PHP, its core its a fast micro-framework implementation (Lumen), and capable of delivering GraphQL (Relay) API responses.

###### React-Relay Modern, aka GraphQL v1.\*

## Index of content

* [Introduction](#introduction)
* [Who is this for?](#who-is-this-for)
* [Included features](#included-features)
* [Client Web App](#client-web-app)
* [Installation](#installation)
* [Configuration](#configuration)
* [How to use](#how-to-use)
* [Query examples endpoints](#query-examples-endpoints)
* [More TODO examples](https://github.com/kikoseijo/lumen-relay-boilerplate/blob/master/docs/examples.md)
* [Used plugins & references](#plugins)
* [Credits](#credits)

## Introduction

On this [Lumen](http://lumen.laravel.com) version of a GraphQL server implementation you will be able to start coding right away a fully qualified GraphQL server with support for react-relay (Modern version).

With a [Laravel](http://laravel.com) heart, on his delighting micro-framework version (Lumen) and a help of a couple of other [packages/plugins](#plugins), we provide you with the basic server setup.

##### Why Lumen? and why PHP?

Why not my little Artisan? PHP limitations today for a GraphQL server are asynchronous calls, but this are problems PHP programmers been dealing with since the old days, the missing part are the GraphQL subscriptions, this can be resolved using lots of tools, like Redis or NodeJS.

PHP never been so optimized like it is today, its stable, fast and efficient. And Lumen?, because its a masterpiece, a lightweight version of Laravel, sharing same core and data structure. Perfect for building APIs.

For little Artisan like myself this is the perfect atmosphere to understand how things are achieved.

## Who is this for?

People wanting to get hands dirty with GraphQL, to serve as a boilerplate to kick-off API projects, a knowledge of Laravel its recommended, at a installation level, not covered here.

## Included features

* Full CRUD example.
* GraphQL Playground.
* Database migrations.
* GraphQl database schema generator and endpoint.
* User authentication using Passport.
* Ready to start after setup!

## Client Web App

If you work with React we have published for you an application, there you can test all demo features, its a React + Relay based Web App. This is probably best way to have a full picture of what Relay its capable off, in my opinion, one of the best facebook´s open sourced contribution and React´s best friend. 💑

[Visit the React Relay - WebApp client](https://github.com/kikoseijo/react-relay-app).

## Installation

When building this boilerplate the package able to supercharge Lumen with GraphQL had bugs, untill this gets fixed, use my forked repo, or read the PR with the fix to adjust yours.

#### 1 . Change path repo for this:

Configure # package.json with this repo, replace the "path" for this.

```json
"repositories": [
  {
    "type": "csv",
    "url": "https://github.com/kikoseijo/laravel-graphql"
  }
],
```

[PR with the fix](https://github.com/Folkloreatelier/laravel-graphql/pull/268) in case you want to make it yourself.

_Due to development and understand code i use a path repo, read logs and so..._

#### 2 . Configure your database laravel way, using .env

If you don´t know how to pass this point, head over to [Laravel](http//laravel.com) and start there, come back after.

#### 3 . Setup a valid key for encryption to work

```
APP_KEY=base64:4aVuW541oT+8kaM8VA/BkdfiuUloIHyihoGsCAY6Yt4=
```

## Configuration

Go to your seeder and adjust your user login, migrate and seed the database.

> Ready to go?, so, lets go!

## How to use

There is a full crud structure ready to show you how creation, deletion and update of records are done, its a simple TODO structure, single table, no relationships, but, you have the user 1:n with the Todo table. This are called Connections on the GraphQL world.

By browsing to `/schema.json` you can retrieve the latest version of your .json schema. This is needed for the GraphQL client. We wont go into this, its up to you to find more information about it.

Thanks to [laravel-graphql](https://github.com/Folkloreatelier/laravel-graphql) you are also able to test your endpoints and queries using the bundled client, just by browsing to `/graphql`.

## Query examples endpoints

Here are couple of examples, this are GraphQL queries and mutations, you can find couple more examples in the [/docs](/docs) folder of this repo.

#### Login

Using Laravel Passport we are able to generate token based auth method, you can build more complex methods, this is one of them.

```graphql
mutation {
  login(email: "kiko@example.com", password: "secret") {
    user {
      id
      name
    }
    token
  }
}
```

To access Authenticated routes you must include the Bearer token in your requests, after a valid login, the server provides you a token, use this token to authenticate your GraphQL Client adding an HTTP Header with the following structure:

```json
{
  "Authorization": "Bearer PASTE_HERE_YOUR_TOKEN"
}
```

#### Query with Fragments

One of the coolest features GraphQL+Relay its how queries from different parts of the application are joined by the compiler trying to optimize efficiency.

Queries are pre compiled and validated against the development or production server schema, this gives you an extra layer of compatibility on development stages.

The following Query its in charge of 1. Gets the current logged in user, 2. ask for user todos, 3. tells GraphQL server how and what data we want.

```graphql
query TodoQuery {
  viewer {
    ...TodoApp_viewer
    id
  }
}

fragment TodoApp_viewer on User {
  id
  totalCount
  ...TodoListFooter_viewer
  ...TodoList_viewer
}

fragment TodoListFooter_viewer on User {
  id
  completedCount
  completedTodos: todos(status: "completed", first: 2147483647) {
    edges {
      node {
        id
        complete
      }
    }
  }
  totalCount
}

fragment TodoList_viewer on User {
  todos(first: 2147483647) {
    edges {
      node {
        id
        complete
        ...Todo_todo
        __typename
      }
      cursor
    }
    pageInfo {
      endCursor
      hasNextPage
    }
  }
  id
  totalCount
  completedCount
  ...Todo_viewer
}

fragment Todo_todo on Todo {
  complete
  id
  text
}

fragment Todo_viewer on User {
  id
  totalCount
  completedCount
}
```

Here you have a picture of this query using the [GraphQL Playground App](https://github.com/graphcool/graphql-playground), thats also free to download!

![Mutation example](/public/img/mutation.png?raw=true 'Mutation GraphQL Playground example')

More examples? [<<<< click here >>>>](https://github.com/kikoseijo/lumen-relay-boilerplate/blob/master/docs/examples.md)

#### Thats all for now folks!

I kindly **_invite you to participate_** with your PR, reporting bugs or any configuration issues you might find, i can guarantee you that will share any stars you give this repo with the people thats done the **_hard work_**, because i haven´t, all i did was put couple packages together. 😝

## Plugins

Every plugin has their own plugins, cant put them all in here, i´m only referencing the top level packages for you to have a quick reference to them to learn or ask any issues you might have.

* [Laravel Lumen micro-framework](http://lumen.laravel.com) best PHP API ever made.
* [Laravel Passport](https://laravel.com/docs/master/passport) provides several authentication mechanism.
* [Webonyx graphql-php](https://github.com/webonyx/graphql-php) a PHP port of GraphQL reference implementation.
* [Folkloreatelier laravel-graphql](https://github.com/Folkloreatelier/laravel-graphql) it supercharge Webonyx with a Laravel + Lumen version.
* [Digiaonline lumen-cors](https://github.com/digiaonline/lumen-cors) no reactive apps with CORS browser restriction.
* [Spatie laravel-activitylog](https://github.com/spatie/laravel-activitylog) lovely handy logs, made simple, by the Spatie people.

## Credits

* [GraphQL](http://graphql.org) facebook´s open sourced.
* [Kiko Seijo](http://kikoseijo.com 'Laravel, React, Vue, Mobile freelancer in Málaga'), Senior WWW architect.
* [Diseño ideas](http://disenoideas.com 'Real estate website designer in Marbella'), Marbella based design agency.

**Sunnyface.com**, it´s a software development company based in **Málaga, South Spain**. We provide cloud based quality software, reactive App or Native development for iOS and Android, we work with local & international companies, providing technology solutions with the [most modern programming languages](https://sunnyface.com/tecnologia/ 'Programador experto react y vue en Málaga').

[DevOps](https://sunnyface.com 'Programador ios málaga Marbella') Web development  
[Custom App Development](https://gestorapp.com 'Gestor de aplicaciones moviles en málaga, mijas, marbella') Mobile aplications  
[Social Apps and Startups](https://sosvecinos.com 'Plataforma móvil para la gestion de comunidades') Residents mobile application  
[Graphic designer](https://kikoseijo.com 'Programador freelance movil y Laravel') Freelance senior programmer

---

<div dir=rtl markdown=1>Created by <b>Kiko Seijo</b> on 2018</div>
