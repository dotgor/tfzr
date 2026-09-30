# AGENTS.md

## Project overview

This repository is a legacy PHP web application for managing student records, printing student data, and handling student-related admin flows. It is not a framework app and does not use Composer, npm, or a modern MVC structure.

Key project patterns:
- Entry pages such as `index.php`, `unos.php`, `StudentiLista.php`, and `Welcome.php` generate the page output.
- Reusable page fragments live in `delovi/` and are included with PHP `include` statements.
- Database access classes live in `klase/` and follow a pattern of one connection class plus table-specific classes like `DBStudent`, `DBSmer`, and `DBKorisnik`.
- Database configuration is XML-based and stored in `klase/BaznaParametriKonekcije.xml`.
- The schema notes and stored-procedure notes are in `bazapodataka/`.

## How this project is structured

- `index.php` and similar root files: page controllers / rendered views
- `delovi/`: shared layout blocks such as headers, footers, menus, and content panels
- `css/`: stylesheet generation via PHP (`stil.php`)
- `klase/`: connection logic, generic table helpers, and domain-specific DB classes
- `bazapodataka/`: database scripts and notes
- `SlikeStudenata/`: uploaded student images

## Coding conventions to preserve

- Keep the code in the project's native legacy PHP style: direct includes, no namespaces, no framework conventions.
- Follow the existing naming style in Serbian/Croatian-heavy identifiers and class names (for example `Konekcija`, `Tabela`, `DajSvePodatkeOStudentima`, `UcitajSvePoUpitu`).
- Reuse the existing DB-layer classes instead of creating ad hoc database access logic in page files.
- Preserve the established flow: open connection via `Konekcija`, then instantiate a table-specific class from `klase/` and call its methods.
- Keep UTF-8 handling and session management consistent with existing pages (`session_start()`, `mysqli_set_charset(..., "utf8")`).
- Do not introduce new frameworks or build tools unless the task explicitly requires them.

## Safe editing patterns

- Before changing database behavior, inspect the relevant class in `klase/` first, especially `BaznaKonekcija.php`, `BaznaTabela.php`, and the domain class being used.
- If a change affects a page layout, check the matching include file in `delovi/` before editing the root page.
- When adding a new page or feature, mirror the existing include pattern and keep HTML fragments in `delovi/` where possible.
- Keep changes small and local; this project is highly procedural and relies on many direct includes.
- Preserve SQL naming and column casing that already exists in the database schema.

## Validation

There is no package.json or modern test suite in this repo. For PHP changes, validate with:

```bash
php -l <file.php>
```

For page-level verification, run the app in a PHP-enabled local environment and confirm the page loads without fatal errors.

## Useful reference files

- `klase/BaznaKonekcija.php` — database connection setup and charset configuration
- `klase/BaznaTabela.php` — shared database access methods and SQL helpers
- `klase/DBStudent.php` — concrete CRUD pattern for student operations
- `BaznaParametriKonekcije.xml` — database credentials and schema naming
- `bazapodataka/BazaPodataka.txt` — schema notes

## Notes for AI coding agents

- Prefer minimal edits that fit the legacy PHP architecture over refactoring to a different pattern.
- When debugging, trace the page flow from the root script into the `klase/` classes rather than chasing UI-only symptoms.
- If a feature touches multiple layers, update the relevant page, the DB class, and any corresponding layout include together.
