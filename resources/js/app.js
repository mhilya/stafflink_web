import './bootstrap';
import Alpine from 'alpinejs';
import Chart from 'chart.js/auto';

window.Alpine = Alpine;
window.Chart = Chart;

Alpine.start();

document.addEventListener('DOMContentLoaded', function() {
    initializeCharts();
});

async function initializeCharts() {
    // Promotion Chart
    const promoCanvas = document.getElementById('promotionChart');
    if (promoCanvas) {
        try {
            // Mengambil data promosi dari endpoint Laravel yang terhubung ke Python API
            const response = await fetch('/api/promotion-stats');
            const data = await response.json();

            const promotedCount = data.promoted || 0;
            const notPromotedCount = data.not_promoted || 0;

            renderPromotionChart(promoCanvas, promotedCount, notPromotedCount);

            // Update fallback chart jika JS aktif
            updateChartFallback(promotedCount, notPromotedCount);

        } catch (error) {
            console.error('Error fetching promotion data:', error);
            // Gunakan data default jika API error
            const promotedCount = parseInt(promoCanvas.dataset.promoted) || 0;
            const notPromotedCount = parseInt(promoCanvas.dataset.notPromoted) || 0;
            renderPromotionChart(promoCanvas, promotedCount, notPromotedCount);
        }
    }
}

function renderPromotionChart(canvas, promotedCount, notPromotedCount) {
    return new Chart(canvas, {
        type: 'bar',
        data: {
            labels: ['Dipromosikan', 'Tidak Dipromosikan'],
            datasets: [{
                label: 'Jumlah Karyawan',
                data: [promotedCount, notPromotedCount],
                backgroundColor: [
                    'rgba(59, 130, 246, 0.7)',
                    'rgba(156, 163, 175, 0.7)'
                ],
                borderColor: [
                    'rgba(59, 130, 246, 1)',
                    'rgba(156, 163, 175, 1)'
                ],
                borderWidth: 1,
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `Jumlah: ${context.raw}`;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: calculateStepSize(promotedCount, notPromotedCount),
                        precision: 0
                    }
                }
            }
        }
    });
}

function calculateStepSize(promoted, notPromoted) {
    const maxCount = Math.max(promoted, notPromoted);
    if (maxCount <= 5) return 1;
    if (maxCount <= 20) return 2;
    return Math.ceil(maxCount / 5);
}

function updateChartFallback(promotedCount, notPromotedCount) {
    const fallback = document.getElementById('chartFallback');
    if (fallback) {
        // Update fallback visualization
        const promotedBar = fallback.querySelector('.bg-blue-500');
        const notPromotedBar = fallback.querySelector('.bg-gray-400');
        const promotedValue = fallback.querySelector('span.font-bold:first-of-type');
        const notPromotedValue = fallback.querySelector('span.font-bold:last-of-type');

        if (promotedBar && notPromotedBar && promotedValue && notPromotedValue) {
            const maxHeight = Math.max(promotedCount, notPromotedCount, 1);
            promotedBar.style.height = `${(promotedCount / maxHeight) * 100}%`;
            notPromotedBar.style.height = `${(notPromotedCount / maxHeight) * 100}%`;
            promotedValue.textContent = promotedCount;
            notPromotedValue.textContent = notPromotedCount;
        }
    }
}
