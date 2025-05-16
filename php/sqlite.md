To view your `sqlite.db` file from the terminal, you can use the `sqlite3` command-line tool. Here’s how to do it:

### ✅ Steps to View the Database

1. **Navigate to the directory containing the DB:**

```bash
cd ~/public_html/hugo/db
```

2. **Open the database with SQLite:**

```bash
sqlite3 sqlite.db
```

You’ll now be in the SQLite shell.

3. **List all tables:**

```sqlite
.tables
```

4. **View schema of a table (e.g., `users`):**

```sqlite
.schema users
```

5. **View all rows in the `users` table:**

```sqlite
SELECT * FROM users;
```

6. **Exit SQLite shell:**

```sqlite
.quit
```

---

### 💡 Tip: Get a formatted table view

You can enable column formatting and headers:

```sqlite
.mode column
.headers on
SELECT * FROM users;
```

Let me know if you want a helper script or alias to simplify this!
