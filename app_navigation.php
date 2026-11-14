<?php
$currentPage = basename($_SERVER['SCRIPT_NAME'] ?? '');

$navigationUsername = htmlspecialchars(
    (string) ($_SESSION['username'] ?? 'Staff member'),
    ENT_QUOTES,
    'UTF-8'
);

$navigationRole = (string) ($_SESSION['role'] ?? '');

$navigationRoleLabels = [
    'CaseWorker' => 'Case Worker',
    'Supervisor' => 'Supervisor',
    'Admin' => 'Administrator',
];

$navigationRoleLabel = htmlspecialchars(
    $navigationRoleLabels[$navigationRole] ?? $navigationRole,
    ENT_QUOTES,
    'UTF-8'
);

$canAccessCaseModules = in_array(
    $navigationRole,
    ['CaseWorker', 'Supervisor', 'Admin'],
    true
);

$navigationLinks = [
    ['dashboard.php', 'dashboard.php', 'bi-grid-1x2', 'Overview'],
];

if ($canAccessCaseModules) {
    $navigationLinks[] = [
        'beneficiaries.php?view=list',
        'beneficiaries.php',
        'bi-people',
        'Beneficiaries'
    ];

    $navigationLinks[] = [
        'cases.php',
        'cases.php',
        'bi-folder2-open',
        'Cases'
    ];

    $navigationLinks[] = [
        'referrals.php',
        'referrals.php',
        'bi-arrow-up-right-circle',
        'Referrals'
    ];

    $navigationLinks[] = [
        'follow_ups.php?filter=upcoming',
        'follow_ups.php',
        'bi-calendar-check',
        'Follow-ups'
    ];
}
?>

<header class="app-navigation">
    <div class="app-navigation-inner">
        <div class="app-navigation-top">
            <a href="dashboard.php" class="app-brand">
                <span class="app-brand-icon" aria-hidden="true">
                    <i class="bi bi-shield-check"></i>
                </span>

                <span>
                    <strong>NGO Portal</strong>
                    <small>Case Management Information System</small>
                </span>
            </a>

            <div class="app-user-tools">
                <div class="app-user">
                    <span class="app-user-name">
                        <?= $navigationUsername ?>
                    </span>
                    <span class="app-user-role">
                        <?= $navigationRoleLabel ?>
                    </span>
                </div>

                <button
                    type="button"
                    class="app-theme-button"
                    data-app-theme-toggle
                    aria-label="Switch theme"
                >
                    <i class="bi bi-moon-stars"
                       data-theme-icon
                       aria-hidden="true"></i>
                    <span data-theme-label>Theme</span>
                </button>
            </div>
        </div>

        <nav class="app-nav-links" aria-label="Main navigation">
            <?php foreach ($navigationLinks as [$href, $page, $icon, $label]): ?>
                <a
                    href="<?= htmlspecialchars($href, ENT_QUOTES, 'UTF-8') ?>"
                    class="app-nav-link"
                    <?= $currentPage === $page ? 'aria-current="page"' : '' ?>
                >
                    <i class="bi <?= htmlspecialchars($icon, ENT_QUOTES, 'UTF-8') ?>"
                       aria-hidden="true"></i>
                    <?= htmlspecialchars($label, ENT_QUOTES, 'UTF-8') ?>
                </a>
            <?php endforeach; ?>
        </nav>
    </div>
</header>