---
applyTo: "**/*.php"
description: "Database and UI conventions used in this legacy PHP student management app."
---

# PHP database and UI conventions for this repository

This repository uses a procedural PHP design, not a framework or ORM. Follow the patterns already used in the app instead of introducing new abstractions.

## Database access pattern

- Open the database connection through `Konekcija` from `klase/BaznaKonekcija.php`.
- Load XML connection settings from `klase/BaznaParametriKonekcije.xml`.
- Typical pattern:

```php
require "klase/BaznaKonekcija.php";
require "klase/BaznaTabela.php";

$KonekcijaObject = new Konekcija('klase/BaznaParametriKonekcije.xml');
$KonekcijaObject->connect();

if ($KonekcijaObject->konekcijaDB) {
    $RedVoznjeObject = new Tabela($KonekcijaObject, 'red_voznje');
  $RedVoznjeObject->UcitajSve('id');
}
```

  - Reuse the shared `Tabela` class for timetable and city queries, and `DBRedVoznjeSP` for stored-procedure insertion.
- Keep the legacy flow of `connect() -> instantiate table class -> call CRUD/query method -> disconnect()`.
- Preserve the main DB helper methods already used in `BaznaTabela.php`:
  - `UcitajSvePoUpitu($Upit)`
  - `DajVrednostPoRednomBrojuZapisaPoRBPolja($Kolekcija, $RBZapisa, $RBPolja)`
  - `IzvrsiAktivanSQLUpit($AktivanSQLUpit)`
  - `PostojiZapis($KriterijumFiltriranja)`
- When a page needs data from a joined or filtered query, build a SQL query and pass it to `UcitajSvePoUpitu()`.
- Keep SQL names and column names exactly as they exist in the database schema and the current classes.
- Do not create ad hoc database logic in page files when an existing DB helper already exists.

## Connection and charset conventions

- The XML file stores:
  - `host`
  - `korisnik`
  - `sifra`
  - `prefiks_baze_podataka`
  - `naziv_baze_podataka`
- The project builds the database name as `prefiks_baze_podataka + naziv_baze_podataka` in `BaznaKonekcija.php`.
- Keep the UTF-8 setup pattern:

```php
mysqli_set_charset($this->konekcijaDB, "utf8");
```

- Do not replace the project’s direct mysqli/mysql handling with new abstraction layers or ORM code.

## UI page pattern

- Root pages and form handlers are procedural PHP scripts, not controllers in a framework.
- The page structure follows a consistent layout pattern:
  - start PHP logic at the top
  - read session state with `session_start()`
  - redirect to `index.php` when a protected page is accessed without a valid session
  - load data from the database
  - include one or more templates from `delovi/`
  - render HTML with inline tables and simple form markup

- Typical authentication guard pattern:

```php
session_start();
$korisnik = $_SESSION["korisnik"];

if (!isset($korisnik)) {
    header('Location:index.php');
}
```

- Layout fragments live in `delovi/` and are included with plain PHP `include` statements.
- The project uses a table-heavy HTML structure, not modern component-based layouts.
- CSS is served through `css/stil.php` and included directly in each page.
- Forms are simple POST/GET HTML forms, often using hidden inputs to pass identifiers between pages.

## Page and form implementation conventions

- Use existing page names and include patterns. For example:
  - root page loads layout with `delovi/zaglavljeindex.php`, `delovi/desnopocetna.php`, and `delovi/footer.php`
  - listing pages load `delovi/desnoRedvoznjeLista.php`
  - edit forms load `delovi/desnoRedvoznjeIzmeniForm.php`
- Preserve the current markup style: inline `style` attributes, `<table>`, `border`, `cellpadding`, `cellspacing`, and `font` tags already used in the project.

## Data-access and UI action patterns already in use

- Listing data: query a table or view, then iterate rows with `for` loops and call `DajVrednostPoRednomBrojuZapisaPoRBPolja()`.
- Deletion: use a POST form with `IdRedaVoznje` and delete through `Tabela::IzvrsiAktivanSQLUpit()`.
- Update: use a hidden `IdRedaVoznje` value and update the timetable row through `Tabela`.
- Insert: use `Tabela` for ordinary insertion or `DBRedVoznjeSP::DodajRedVoznje()` for the stored-procedure flow.
- Form actions commonly redirect back to the timetable list after success using `header('Location:RedvoznjeLista.php');`.

## Constraints for future edits

- Do not introduce namespaces, Composer, MVC structure, frontend frameworks, ORMs, or modern component systems.
- Do not refactor toward a new architecture while keeping the same feature.
- Do not replace legacy include-based page composition with a new templating system.
- Do not add abstraction layers that are not already present in this repo.
- Keep changes small and local to the existing procedural flow.

## Validation

For PHP changes, validate with:

```bash
php -l <file.php>
```

Page-level verification should be done by running the app in a PHP-enabled environment and checking that the page loads without fatal errors.
