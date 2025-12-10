<?php
require_once 'lib/auth.php';
require_once 'lib/db.php';
require_once 'lib/utils.php';

require_login();

$page_title = 'Analytics Dashboard';
$user_id = current_user_id();

// Get or update user stats
$stats = get_user_stats($user_id);
if (!$stats) {
    update_user_stats($user_id);
    $stats = get_user_stats($user_id);
}

// Get mood distribution for last 30 days
$mood_data = db_all("CALL sp_get_mood_distribution(?, DATE_SUB(CURDATE(), INTERVAL 30 DAY), CURDATE())", [$user_id]);

// Get writing calendar for current year
$calendar_data = db_all("CALL sp_get_writing_calendar(?, YEAR(CURDATE()))", [$user_id]);

// Get category breakdown
$category_stats = db_all("SELECT c.category_name, c.color, c.icon, COUNT(e.entry_id) as count
                          FROM categories c
                          LEFT JOIN entries e ON c.category_id = e.category_id AND e.user_id = ? AND e.is_deleted = FALSE
                          GROUP BY c.category_id
                          HAVING count > 0
                          ORDER BY count DESC", [$user_id]);

// Get recent activity
$recent_entries = db_all("SELECT DATE(timestamp) as date, COUNT(*) as count
                          FROM entries
                          WHERE user_id = ? AND is_deleted = FALSE
                          AND timestamp >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)
                          GROUP BY DATE(timestamp)
                          ORDER BY date DESC
                          LIMIT 30", [$user_id]);

// Calculate this month's stats
$this_month_count = db_one("SELECT COUNT(*) as count FROM entries 
                             WHERE user_id = ? AND is_deleted = FALSE 
                             AND MONTH(timestamp) = MONTH(CURDATE()) 
                             AND YEAR(timestamp) = YEAR(CURDATE())", [$user_id])['count'];

include 'partials/head.php';
include 'partials/nav.php';
?>

<div class="min-h-screen bg-gray-900 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-white mb-2">Analytics Dashboard</h1>
            <p class="text-gray-400">Your writing insights and statistics</p>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-gradient-to-br from-blue-500 to-blue-700 rounded-lg p-6 text-white">
                <div class="text-4xl mb-2">📝</div>
                <p class="text-blue-100 text-sm font-medium">Total Entries</p>
                <p class="text-3xl font-bold mt-1"><?= $stats['total_entries'] ?? 0 ?></p>
            </div>

            <div class="bg-gradient-to-br from-green-500 to-green-700 rounded-lg p-6 text-white">
                <div class="text-4xl mb-2">🔥</div>
                <p class="text-green-100 text-sm font-medium">Current Streak</p>
                <p class="text-3xl font-bold mt-1"><?= $stats['current_streak'] ?? 0 ?> days</p>
            </div>

            <div class="bg-gradient-to-br from-purple-500 to-purple-700 rounded-lg p-6 text-white">
                <div class="text-4xl mb-2">✍️</div>
                <p class="text-purple-100 text-sm font-medium">Total Words</p>
                <p class="text-3xl font-bold mt-1"><?= number_format($stats['total_words'] ?? 0) ?></p>
            </div>

            <div class="bg-gradient-to-br from-orange-500 to-orange-700 rounded-lg p-6 text-white">
                <div class="text-4xl mb-2">📅</div>
                <p class="text-orange-100 text-sm font-medium">This Month</p>
                <p class="text-3xl font-bold mt-1"><?= $this_month_count ?></p>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Mood Distribution -->
            <div class="bg-gray-800 rounded-lg p-6">
                <h2 class="text-xl font-semibold text-white mb-4">Mood Distribution (Last 30 Days)</h2>
                <?php if (!empty($mood_data)): ?>
                <div class="space-y-3">
                    <?php foreach ($mood_data as $mood): ?>
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-300"><?= mood_emoji($mood['mood']) ?> <?= e($mood['mood']) ?></span>
                            <span class="text-gray-400"><?= $mood['percentage'] ?>%</span>
                        </div>
                        <div class="w-full bg-gray-700 rounded-full h-2">
                            <div class="bg-blue-500 rounded-full h-2" style="width: <?= $mood['percentage'] ?>%"></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php else: ?>
                <p class="text-gray-400 text-center py-8">No mood data available</p>
                <?php endif; ?>
            </div>

            <!-- Category Breakdown -->
            <div class="bg-gray-800 rounded-lg p-6">
                <h2 class="text-xl font-semibold text-white mb-4">Category Breakdown</h2>
                <?php if (!empty($category_stats)): ?>
                <div class="space-y-3">
                    <?php foreach ($category_stats as $cat): ?>
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-300"><?= e($cat['icon']) ?> <?= e($cat['category_name']) ?></span>
                            <span class="text-gray-400"><?= $cat['count'] ?> entries</span>
                        </div>
                        <div class="w-full bg-gray-700 rounded-full h-2">
                            <div class="rounded-full h-2" style="width: <?= ($cat['count'] / $stats['total_entries']) * 100 ?>%; background-color: <?= e($cat['color']) ?>"></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php else: ?>
                <p class="text-gray-400 text-center py-8">No category data available</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Additional Stats -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="bg-gray-800 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-white mb-4">Writing Stats</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-400">Avg Words/Entry</span>
                        <span class="text-white font-semibold"><?= number_format($stats['avg_words_per_entry'] ?? 0, 0) ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Longest Streak</span>
                        <span class="text-white font-semibold"><?= $stats['longest_streak'] ?? 0 ?> days</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Most Common Mood</span>
                        <span class="text-white font-semibold"><?= $stats['most_common_mood'] ? mood_emoji($stats['most_common_mood']) . ' ' . $stats['most_common_mood'] : '-' ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Last Entry</span>
                        <span class="text-white font-semibold"><?= $stats['last_entry_date'] ? date('M d, Y', strtotime($stats['last_entry_date'])) : '-' ?></span>
                    </div>
                </div>
            </div>

            <div class="bg-gray-800 rounded-lg p-6 lg:col-span-2">
                <h3 class="text-lg font-semibold text-white mb-4">Recent Activity</h3>
                <?php if (!empty($recent_entries)): ?>
                <div class="grid grid-cols-7 gap-2">
                    <?php foreach (array_reverse($recent_entries) as $entry): ?>
                    <div class="text-center">
                        <div class="text-xs text-gray-400 mb-1"><?= date('M j', strtotime($entry['date'])) ?></div>
                        <div class="h-12 bg-blue-500 rounded" style="opacity: <?= min($entry['count'] / 3, 1) ?>; height: <?= min($entry['count'] * 20, 48) ?>px"></div>
                        <div class="text-xs text-gray-500 mt-1"><?= $entry['count'] ?></div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php else: ?>
                <p class="text-gray-400 text-center py-8">No recent activity</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Action Button -->
        <div class="mt-8 text-center">
            <button onclick="location.reload()" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300">
                🔄 Refresh Stats
            </button>
        </div>
    </div>
</div>

<?php include 'partials/footer.php'; ?>
