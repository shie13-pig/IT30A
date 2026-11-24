<?php
$currentSection = $_GET['section'] ?? 'dashboard';

function navActive($section,$currentSection){
    return $section === $currentSection ? 'active' : '';
        }

?>

<!--- Material Icons -->
    <link href= "https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style>
        .app-header{
            display:flex;
            justify-content: space-between;
            align-items: center;
            margin-bottons: 2 rem;
            flex-wrap: wrap;
            gap:1rem;
            font-family: Roboto,system-ui,-apple-system, sans-serif;
        }

        .app-header h1{
            font-weight: 400;
            font-size: 1.8rem;
            display:flex;
            align-items: center;
            gap: 0.5rem;
            color: #212121;
            margin:0;
        }

        .app-header h1 material-icons{
            font-size: 2.2rem;
            color: #1976d2;
        }

        .nav-links{
            display: flex;
            gap:0.2rem;
            background: transparent;
        }

        .nav-links a{
            text-decoration:none;
            color: #616161;
            font-size:0.9rem;
            front-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding:.6rem 1.2rem;
            border-radius: 4px;
            transition: background-color 0.2s,color 0.2s;
            display:flex;
            align-items: center;
            gap: .35rem;
        }

        .nav-links a .material-icons{
            font-size:1.2rem;
        }

        .nav-links a:hover{
            background: #e3f2fd;
            color: #1976d2;
        }

        .nav-links a.active{
            background: #1976d2;
            color:white;
            box-shadow: 0 2px 2px 0 rgba(0,0,0 .14), 0 3px 1px -2px rgba(0,0,0, .12),0 1px 5px 0 rgba(0,0,0, .2);
        }

         .nav-links a.active .material-icons{
            color: white;
        }

        @media(max-width:760px){
            .app-header{
                flex-direction:column;
                align-items: flex-start;
            }

             .nav-links{
                width:100%;
                overflow-x: auto;
                padding-bottom: 0.5rem;
        }
            .nav-links a{
            padding: .5rem .8rem;
            font-size: .8rem;
            white-space: nowrap;
        }
}
    </style>

<header class="app-header">
    <h1>
        <span class="material-icons">local_library</span>
        Library Dashboard
    </h1>

    <nav class="nav-links">

    <a href="index.php?section=dashboard" class="<?= navActive('dashboard', $currentSection) ?>">
        <span class="material-icons">dashboard</span>
        Dashboard
    </a>
     <a href="index.php?section=students" class="<?= navActive('students', $currentSection) ?>">
        <span class="material-icons">people</span>
        Students
    </a>
    <a href="index.php?section=books" class="<?= navActive('books', $currentSection) ?>">
        <span class="material-icons">menu_book</span>
        Books
    </a>
    <a href="index.php?section=borrow" class="<?= navActive('borrow', $currentSection) ?>">
        <span class="material-icons">swap_horiz</span>
        Borrow
    </a>

</nav>

</header>

<?php 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>

    <?php include 'includes/navbar.php' 
    // ---------- 2. BOOKS BY CATEGORY ----------
$catStmt = $pdo->query("
    SELECT book_category, COUNT(*) AS cnt
    FROM books
    GROUP BY book_category
    ORDER BY cnt DESC
");
$categories = [];
$categoryCounts = [];
while ($row = $catStmt->fetch()) {
    $categories[]     = $row['book_category'];
    $categoryCounts[] = (int) $row['cnt'];
}

    ?>

    <div class="stats-grid">
    <div class="stat-card">
        <div class="stat-header">
            <span class="stat-label">Students</span>
            <span class="material-icons">school</span>
        </div>
        <div class="stat-number"><?= $studentCount ?></div>
        <div class="stat-sub">enrolled</div>
    </div>

    <div class="stat-card">
        <div class="stat-header">
            <span class="stat-label">Books</span>
            <span class="material-icons">auto_stories</span>
        </div>
        <div class="stat-number"><?= $bookCount ?></div>
        <div class="stat-sub">in collection</div>
    </div>

    <div class="stat-card">
        <div class="stat-header">
            <span class="stat-label">Borrow records</span>
            <span class="material-icons">history</span>
        </div>
        <div class="stat-number"><?= $totalBorrows ?></div>
        <div class="stat-sub">all time</div>
    </div>

    <div class="stat-card">
        <div class="stat-header">
            <span class="stat-label">Active loans</span>
            <span class="material-icons">pending_actions</span>
        </div>
        <div class="stat-number"><?= $activeBorrows ?></div>
        <div class="stat-sub">not returned</div>
    </div>
</div>

    <script>
    (function() {
        // Materialize standard palette
        const colors = {
            blue: '#1976d2',
            green: '#4caf50',
            orange: '#ff9800',
            red: '#f44336',
            purple: '#9c27b0',
            grey: '#9e9e9e'
        };

        // ---------- DOUGHNUT : BOOKS BY CATEGORY ----------
        const catCtx = document.getElementById('categoryChart').getContext('2d');
        new Chart(catCtx, {
            type: 'doughnut',
            data: {
                labels: <?= json_encode($categories) ?>,
                datasets: [{
                    data: <?= json_encode($categoryCounts) ?>,
                    backgroundColor: [
                        colors.blue, colors.green, colors.orange, colors.red, colors.purple, colors.grey
                    ],
                    borderWidth: 2,
                    borderColor: '#ffffff',
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                cutout: '65%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            boxWidth: 12,
                            boxHeight: 12,
                            usePointStyle: false, // Materialize usually uses squares
                            padding: 16,
                            font: { size: 12, family: 'Roboto' },
                            color: '#616161'
                        }
                    },
                    tooltip: {
                        backgroundColor: '#212121',
                        titleColor: '#ffffff',
                        bodyColor: '#ffffff',
                        padding: 10,
                        cornerRadius: 4,
                        displayColors: true,
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.parsed || 0;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const pct = total > 0 ? ((value / total) * 100).toFixed(0) : 0;
                                return ` ${label}: ${value} (${pct}%)`;
                            }
                        }
                    }
                }
            }
        });
    })();
</script>
    <!-- CHARTS -->
<div class="charts-grid">

    <!-- Pie Chart - Book Categories-->
    <div class="chart-card">
        <div class="chart-title">
            Books by category
            <span>
                <span class="material-icons">category</span>
                collection
            </span>
        </div>
        <canvas id="categoryChart" width="400" height="200"></canvas>
    </div>

</div>

</nav>
</header>
