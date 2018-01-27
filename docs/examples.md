# Mutation examples

Here you can find the missing mutations from the Todo, this gives you the full
picture of a full CRUD example.

* [Update record](#update-record)
* [Change all Todo status](#change-all-todo-status)
* [Delete completed Todos](#delete-completed-todos)

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

```

Params:

```json

```

Response:

```json

```
