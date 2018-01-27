# Mutation examples

Here you can find the missing mutations from the Todo, this gives you the full
picture of a full CRUD example.

* [Add Todo](#add-todo)
* [Update record](#update-record)
* [Change all Todo status](#change-all-todo-status)
* [Delete completed Todos](#delete-completed-todos)

#### Mutation

When accesing auth routes you have to configure the access token you get when you
login, this is done to validate current logged in User. Configure the GraphQL Client creating a HTTP Header with the following:

```json
{
  "Authorization": "Bearer PASTE_HERE_YOUR_TOKEN"
}
```

#### Add Todo

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

#### Update record

Change todo text field, edit mutation example.

```graphql
mutation RenameTodoMutation($input: RenameTodoInput!) {
  renameTodo(input: $input) {
    todo {
      id
      text
    }
  }
}
```

Params:

```json
{
  "input": {
    "id": "VG9kbzo2Ng==",
    "text": "Updated new name"
  }
}
```

Response:

```json
{
  "data": {
    "renameTodo": {
      "todo": {
        "id": "VG9kbzo3",
        "text": "New name"
      }
    }
  }
}
```

#### Change all Todo status

```graphql
mutation MarkAllTodosMutation($input: MarkAllTodosInput!) {
  markAllTodos(input: $input) {
    changedTodos {
      id
      complete
    }
    viewer {
      id
      completedCount
    }
  }
}
```

Params:

```json
{
  "input": {
    "complete": true
  }
}
```

Response:

```json
{
  "data": {
    "markAllTodos": {
      "changedTodos": [
        {
          "id": "VG9kbzo3",
          "complete": true
        },
        {
          "id": "VG9kbzo4",
          "complete": true
        }
      ],
      "viewer": {
        "id": "VXNlcjptZQ==",
        "completedCount": 5
      }
    }
  }
}
```

#### Delete completed Todos

```graphql
mutation RemoveCompletedTodosMutation($input: RemoveCompletedTodosInput!) {
  removeCompletedTodos(input: $input) {
    deletedTodoIds {
      id
    }
    viewer {
      completedCount
      totalCount
      id
    }
  }
}
```

Params:

```json
{
  "input": []
}
```

Response:

```json
{
  "data": {
    "removeCompletedTodos": {
      "deletedTodoIds": [
        {
          "id": "VG9kbzo3Mw=="
        },
        {
          "id": "VG9kbzo3NA=="
        }
      ],
      "viewer": {
        "completedCount": 0,
        "totalCount": 2,
        "id": "VXNlcjox"
      }
    }
  }
}
```
