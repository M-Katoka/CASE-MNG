# NGO Portal feature update

Open http://127.0.0.1:8081 and sign in again. Existing credentials are unchanged.

## Using the new features

- Case timeline: assessments, interventions, referrals, follow-ups, assignments, documents and closure decisions appear together by date.
- Closure: request closure with an outcome after resolving pending work. A different Supervisor approves or rejects it. Pending-review and closed cases cannot be edited. An Admin cannot bypass supervisor approval.
- Permissions: workers access assigned cases only, including direct links, forms, reminders, searches, exports and downloads. Supervisors/Admins have organisation-wide operational access. Management sees aggregate reports only. Workers retain access to profiles they registered, but not other workers' cases.
- Audit log: supervisors and administrators can filter recorded actions. Passwords and recovery links are never written to the audit details.
- Duplicate detection: identical normalised name and birth date are blocked. Name/contact matches require acknowledgement after supervisor review. Restricted matching records are not disclosed.
- Backup and recovery: administrators create ZIP snapshots of records and attachments. Restore requires the administrator password and typing RESTORE; it creates a safety backup first, verifies document hashes, and invalidates existing sessions. Downloaded backups contain sensitive data and password hashes: keep them private.
- Reports: filter by case opening dates, programme, worker and status; download PDF or genuine XLSX. Management exports contain aggregates only. Excel values are text, not executable formulas.
- Reminders: overdue and next-seven-day activities appear on Overview and Reminders. Referrals missing a due date are flagged; set or change the date in the case. Email/SMS notifications are not configured.
- Password recovery: request recovery on the login screen. An administrator verifies identity, confirms their own password, and shares a private, single-use link valid for 30 minutes. No email service is configured. Recovery invalidates existing sessions.
- Documents: upload PDF, PNG or JPEG files up to 10 MB on an open case. Files are stored outside the web root and downloaded only after case-authorisation and checksum checks. Malware scanning is not configured.

## First steps

Use Team accounts to create individual CaseWorker and Supervisor accounts. Register a beneficiary, open a case, assign a worker and record activities. A separate Supervisor account is needed for closure approval.

## Local operation and maintenance

Database: ngo_imported_v2 on 127.0.0.1:3317. Existing data files remain in work/mysql-test under this task folder. Private documents and backups are in work/ngo-v2-private outside the website folder. Preserve these folders with the application.

PHP needs PDO MySQL, mbstring, fileinfo and ZipArchive. The local/php.ini configuration enables them using XAMPP. From this project directory, run:

    C:\xampp\php\php.exe -c local/php.ini -S 127.0.0.1:8081 -t . router.php

Start the existing database separately with its my.ini. Use the router to restrict access to private application files. Apache must honour the supplied .htaccess restrictions.

Existing databases: back up first, then run app/migrate.php using local/php.ini. The migration retains records and adds missing fields/tables. The original public setup/demo shortcuts are disabled.

Command-line backups and recovery:

    php -c local/php.ini app/maintenance.php backup
    php -c local/php.ini app/maintenance.php restore PATH_TO_BACKUP --confirm-replace

For disaster recovery, provision the original base database schema and apply the migration before restoring. A downloaded backup can be restored from its path using the command above, or placed with its original ngo-*.zip name in the private backups folder for the administrator UI. Backups are manual or command-line initiated; scheduling and archive encryption are not configured.

## Verification and scope

Integration checks used a separate database and private storage. They cover permissions, closure, duplicates, activities, attachments, real exports, recovery expiry/reuse, session invalidation, backups and actual restoration of records plus attachments. Desktop/mobile screens and a generated PDF were inspected.

This is a single-organisation system. Programme is the case-type field. Audit history is application-controlled, not independently tamper-proof. Large-volume performance, penetration testing and production readiness are not claimed. Configure HTTPS, supported PHP, restricted database credentials and protected backups before production use.

To change database connection details, copy config.example.php to config.php and edit the returned values. NGO_DB_HOST, NGO_DB_PORT, NGO_DB_NAME, NGO_DB_USER and NGO_DB_PASSWORD environment variables override them. Configuration files are excluded from the distributable archive.
