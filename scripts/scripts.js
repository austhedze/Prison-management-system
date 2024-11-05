// document.addEventListener("DOMContentLoaded", function () {
//     const ctx = document.getElementById("casePieChart").getContext("2d");

//     const casePieChart = new Chart(ctx, {
//         type: "pie",
//         data: {
//             labels: ["Most Crimes", "Moderate Crimes", "Few Crimes"],
//             datasets: [{
//                 data: [crimeData.most, crimeData.moderate, crimeData.few],
//                 backgroundColor: ["#ff6384", "#36a2eb", "#cc65fe"]
//             }]
//         },
//         options: {
//             responsive: true,
//             plugins: {
//                 legend: {
//                     position: "top",
//                 },
//                 title: {
//                     display: true,
//                     text: "Crime Distribution"
//                 }
//             }
//         }
//     });
// });




// Line Chart for Case Trends
const caseLineChart = new Chart(document.getElementById('caseLineChart'), {
    type: 'line',
    data: {
        labels: ['January', 'February', 'March', 'April', 'May'],
        datasets: [{
            label: 'New Cases',
            data: [10, 20, 30, 40, 50],
            borderColor: '#f58a42',
            backgroundColor: '#f58a42',
            fill: false
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                labels: {
                    color: '#ddd'
                }
            }
        },
        scales: {
            x: {
                ticks: {
                    color: '#ddd'
                }
            },
            y: {
                ticks: {
                    color: '#ddd'
                }
            }
        }
    }
});
