# Lumen + Relay Modern <small>aka: GraphQL 2.0v</small>

This is a Lumen implementation of a GraphQL server written in PHP, you can use it as a boilerplate or just to learn, its created with the purpose of experimenting with this 2 worlds and save a bit of time for people trying to do same thing by reading someone else implementation, We use it to interact with a react applications thats been built using React + Relay Modern, you can read more about he client app here [React Relay Client App](https://github.com/kikoseijo/react-relay-app)

# Install

When writing this the package used to help Lumen be a GraphQL server, needs some fixes that not been resolved, till then, you just have to change to this version other version i have forked with the patch:

#### 1 . Change path repo for this:

```
# package.json
"repositories": [
  {
    "type": "csv",
    "url": "https://github.com/kikoseijo/laravel-graphql"
  }
],
```

_Due to development and understand code i use a path repo, read logs and so..._

#### 2 . Configure your database laravel way, using .env

If you don´t know how to pass this point, head over to [Laravel](http//laravel.com) and start there, come here couple days after. We will be here waiting, don´t worry.

#### 3 . Add a valid key for encryption to work

```
APP_KEY=base64:4aVuW541oT+8kaM8VA/BkdfiuUloIHyihoGsCAY6Yt4=
```

# Configuration

Go to your seeder and setup a user to test logins. After that you are ready to start coding, after you migrate and seed the database, don´t forget!

# How to use

There is a full crud structure ready to show you creation, deletion, update of records, does not goes deep into relationships, but its a perfect starting point. By browsing to `/schema.json` you can inspect the .json schema.

Thanks to [laravel-graphql](https://github.com/Folkloreatelier/laravel-graphql) you are also able to test your endpoints and queries using the bundled client, just by browsing to `/graphql`.

# Built in examples endpoints

#### Login

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

#### Read todos

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

#### Mutation

```graphql
mutation AddTodoMutation($input: AddTodoInput!) {
  addTodo(input: $input) {
    todoEdge {
      __typename
      cursor
      node {
        complete
        id
        text
      }
    }
    viewer {
      id
      totalCount
    }
  }
}
```

Query variables

```json
{
  "input": {
    "text": "Im a new todo thing",
    "clientMutationId": "VXNlcjox"
  }
}
```

Here you have a picture of this query using the [GraphQL Playground App](https://github.com/graphcool/graphql-playground), thats also free to download!

![Mutation example](/public/img/mutation.png?raw=true 'Mutation GraphQL Playground example')

### Thats all for now folks!

I kindly **_invite you to participate_** with your pull requests or just by simply reporting bugs or configuration issues, will share your stars with the real people thats done the **_hard work_**, i have only put them all together on this way to make our life a bit easier.

## Plugins

Every plugin has its own plugins, i´m only referencing here packages that made this implementation possible. For all the other ones i must also say thanks!.

* [Laravel Lumen](http://lumen.laravel.com) best PHP API ever made.
* [](https://github.com/webonyx/graphql-php) a PHP port of GraphQL reference implementation.
* [laravel-graphql](https://github.com/Folkloreatelier/laravel-graphql) A version of webonyx for Laravel + Lumen.
* [lumen-cors](https://github.com/digiaonline/lumen-cors) no reactive apps with CORS browser restriction.
* [Spatie Activity logs](https://github.com/spatie/laravel-activitylog) lovely handy logs, made simple by the Spatie people.

## Credits

Happy coding people:

* [Kiko Seijo](http://kikoseijo.com 'Laravel, React, Vue, Mobile freelancer in Málaga')
* [Diseño ideas](http://disenoideas.com 'Real estate website designer in Marbella')

**Sunnyface.com**, is a software development company from **Málaga, Spain**. We provide quality software based on the cloud for local & international companies, providing technology solutions with the [most modern programming languages](https://sunnyface.com/tecnologia/ 'Programador experto react y vue en Málaga').

[DevOps](https://sunnyface.com 'Programador ios málaga Marbella') Web development  
[Custom App Development](https://gestorapp.com 'Gestor de aplicaciones moviles en málaga, mijas, marbella') Mobile aplications  
[Social Apps and Startups](https://sosvecinos.com 'Plataforma móvil para la gestion de comunidades') Residents mobile application  
[Graphic designer](https://kikoseijo.com 'Programador freelance movil y Laravel') Freelance senior programmer

---

<div dir=rtl markdown=1>Created by <b>Kiko Seijo</b></div>
