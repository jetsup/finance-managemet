// plot departmental budgets
function fetchBudgets() {
    var ajax = new XMLHttpRequest();
    ajax.open("GET", "/budgets", true);
    ajax.setRequestHeader('Content-Type', 'application/json');
    ajax.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
    ajax.onload = function () {
        let response = JSON.parse(this.responseText);
        let departments = response["departments"];
        let departmentsDict = {};
        let departmentsName = {};
        let budgets = response["budgets"];
        let budgetsDict = {};
        let budgetLineDict = {};
        let budgetLineYears = [];

        for (let i in departments) {
            let innerDict = {
                "name": departments[i]["name"],
                "description": departments[i]["description"],
                "head": departments[i]["head_id"],
            };
            departmentsName[departments[i]["name"]] = 0;
            departmentsDict[departments[i]["id"]] = innerDict;
        }
        /*
        "HUMAN RESOURCE": {
            "2014": 120980,
            "2015": 120980,
        }
         */
        for (let i in budgets) {
            let innerDict = {
                "name": budgets[i]["name"],
                "department": departmentsDict[budgets[i]["department_id"]]["name"],
                "project name": budgets[i]["project_name"],
                "allocated budget": budgets[i]["allocated_amount"],
            };
            let budgetLine = {
                "Department": departmentsDict[budgets[i]["department_id"]]["name"],
                "Budget": budgets[i]["allocated_amount"],
            };
            if (!budgetLineYears.includes(getYear(budgets[i]["allocation_date"]))) {
                budgetLineYears.push(getYear(budgets[i]["allocation_date"]));
            }
            if (departmentsDict[budgets[i]["department_id"]]["name"] in budgetLineDict) {
                if (getYear(budgets[i]["allocation_date"]) in budgetLineDict[departmentsDict[budgets[i]["department_id"]]["name"]]) {
                    budgetLineDict[departmentsDict[budgets[i]["department_id"]]["name"]][getYear(budgets[i]["allocation_date"])] += budgets[i]["allocated_amount"];
                } else {
                    budgetLineDict[departmentsDict[budgets[i]["department_id"]]["name"]][getYear(budgets[i]["allocation_date"])] = budgets[i]["allocated_amount"];
                }
            } else {
                budgetLineDict[departmentsDict[budgets[i]["department_id"]]["name"]] = {};
                budgetLineDict[departmentsDict[budgets[i]["department_id"]]["name"]][getYear(budgets[i]["allocation_date"])] = budgets[i]["allocated_amount"];
            }


            departmentsName[departmentsDict[budgets[i]["department_id"]]["name"]] += budgets[i][
                "allocated_amount"
            ];
            budgetsDict[budgets[i]["id"]] = innerDict;
        }
        budgetLineYears.sort();
        console.log(budgetLineYears, budgetLineDict);
        // set every bar with a distinct color
        let datasetColumnColors = Object.keys(departmentsName).map(function (key) {
            return '#' + Math.floor(Math.random() * 16777215).toString(16);
        });
        // chart 1
        var ctx = document.getElementById('budget-chart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: Object.keys(departmentsName),
                datasets: [{
                    // label: "Departments",
                    data: Object.values(departmentsName),
                    backgroundColor: datasetColumnColors,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Budget per Department'
                    }
                }
            }
        });
        // chart 2
        // set every line with a distinct color
        let datasetLineColors = Object.keys(budgetLineDict).map(function (key) {
            return '#' + Math.floor(Math.random() * 16777215).toString(16);
        });
        var ctx = document.getElementById('departmental-budgets-chart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: Object.keys(budgetLineDict["HUMAN RESOURCE"]),
                datasets: [
                    {
                        label: "Human Resource",
                        data: Object.values(budgetLineDict["HUMAN RESOURCE"]),
                        backgroundColor: datasetLineColors[0],
                        borderWidth: 2,
                        borderColor: datasetLineColors[0],
                        // fill: {
                        //     target: "origin", // Set the fill options
                        //     above: "rgba(250, 120, 80, 0.4)", // Set the fill color
                        // }
                    },
                    {
                        label: "Finance",
                        data: Object.values(budgetLineDict["FINANCE"]),
                        backgroundColor: datasetLineColors[1],
                        borderWidth: 2,
                        borderColor: datasetLineColors[1],
                        // fill: "origin"
                    },
                    {
                        label: "Student Affairs",
                        data: Object.values(budgetLineDict["STUDENT AFFAIRS"]),
                        backgroundColor: datasetLineColors[2],
                        borderWidth: 2,
                        borderColor: datasetLineColors[2],
                        // fill: "origin"
                    },
                    {
                        label: "Academics",
                        data: Object.values(budgetLineDict["ACADEMICS"]),
                        backgroundColor: datasetLineColors[3],
                        borderWidth: 2,
                        borderColor: datasetLineColors[3],
                        // fill: "origin"
                    },
                    {
                        label: "Administration",
                        data: Object.values(budgetLineDict["ADMINISTRATION"]),
                        backgroundColor: datasetLineColors[4],
                        borderWidth: 2,
                        borderColor: datasetLineColors[4],
                        // fill: "origin"
                    },
                    {
                        label: "Other",
                        data: Object.values(budgetLineDict["OTHER"]),
                        backgroundColor: datasetLineColors[5],
                        borderWidth: 2,
                        borderColor: datasetLineColors[5],
                        // fill: "origin"
                    }],

            },
            options: {
                scales: {
                    x: {
                        type: 'category',
                        // labels: budgetLineYears, // Include all years here
                    },
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: true
                    },
                    title: {
                        display: true,
                        text: 'Annual Departmental Budgets'
                    }
                },
                responsive: true,
                tension: 0.4,
            }
        })
    };
    ajax.send();
}
fetchBudgets();

function getYear(date) {
    let year = date.split('-')[0];
    // convert to string 
    return year.toString();
}

// plot transactions
function fetchRevenues() {
    var ajax = new XMLHttpRequest();
    ajax.open("GET", "/transactions", true);
    ajax.setRequestHeader('Content-Type', 'application/json');
    ajax.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
    ajax.onload = function () {
        let response = JSON.parse(this.responseText);
        let expenses = response["expenses"];
        let income = response["income"];
        let other = response["other"];

        let expensesDict = {};
        let incomeDict = {};
        let otherDict = {};
        let categoryDict = {};

        for (let expense in expenses) {
            if (expenses[expense].transaction_date in expensesDict) {
                expensesDict[getYear(expenses[expense].transaction_date)] += expenses[expense].amount;
            } else {
                expensesDict[getYear(expenses[expense].transaction_date)] = expenses[expense].amount;
            }
            if ("EXPENSES" in categoryDict) {
                categoryDict["EXPENSES"] += expenses[expense].amount;
            } else {
                categoryDict["EXPENSES"] = expenses[expense].amount;
            }
        }

        for (let inc in income) {
            if (income[inc].transaction_date in incomeDict) {
                incomeDict[getYear(income[inc].transaction_date)] += income[inc].amount;
            } else {
                incomeDict[getYear(income[inc].transaction_date)] = income[inc].amount;
            }
            if ("INCOME" in categoryDict) {
                categoryDict["INCOME"] += income[inc].amount;
            } else {
                categoryDict["INCOME"] = income[inc].amount;
            }
        }

        for (let ot in other) {
            if (other[ot].transaction_date in otherDict) {
                otherDict[getYear(other[ot].transaction_date)] += other[ot].amount;
            } else {
                otherDict[getYear(other[ot].transaction_date)] = other[ot].amount;
            }
            if ("OTHER" in categoryDict) {
                categoryDict["OTHER"] += other[ot].amount;
            } else {
                categoryDict["OTHER"] = other[ot].amount;
            }
        }

        console.log(categoryDict);
        // set every bar with a distinct color
        let datasetColumnColors = Object.keys(categoryDict).map(function (key) {
            return '#' + Math.floor(Math.random() * 16777215).toString(16);
        });
        // transaction chart by category
        var ctx = document.getElementById('transactions-chart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: Object.keys(categoryDict),
                datasets: [{
                    data: Object.values(categoryDict),
                    backgroundColor: datasetColumnColors,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Transactions (Categorically)'
                    }
                }
            }
        });
        // annual transactions
        datasetColumnColors = ["rgba(250, 120, 80, 0.4)", "rgba(160, 120, 255, 0.4)", "rgba(160, 255, 100, 0.4)"]
        var ctx = document.getElementById('annual-transactions-chart').getContext('2d');
        new Chart(ctx, {
            type: "line",
            data: {
                labels: Object.keys(expensesDict),
                datasets: [{
                    label: "Expenses",
                    data: Object.values(expensesDict),
                    backgroundColor: datasetColumnColors[0],
                    borderWidth: 2,
                    borderColor: datasetColumnColors[0],
                    fill: {
                        target: "origin", // Set the fill options
                        above: datasetColumnColors[0], // Set the fill color
                    }
                },
                {
                    label: "Income",
                    data: Object.values(incomeDict),
                    backgroundColor: datasetColumnColors[1],
                    borderWidth: 2,
                    borderColor: datasetColumnColors[1],
                    fill: "origin"
                },
                {
                    label: "Other",
                    data: Object.values(otherDict),
                    backgroundColor: datasetColumnColors[2],
                    borderWidth: 2,
                    borderColor: datasetColumnColors[2],
                    fill: "origin"
                }],
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: true
                    },
                    title: {
                        display: true,
                        text: 'Annual Transactions'
                    }
                },
                responsive: true,
                tension: 0.4,
            }
        });
    };
    ajax.send();
}
fetchRevenues();
