<template>
    <div>
      <!-- <ul>
        <li v-for="employee in employees" :key="employee.id">
          {{ employee.employee_name }} - {{ employee.employee_salary }} USD
        </li>
      </ul> -->
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Employee Name</th>
            <th>Age</th>
            <th>Salary (USD)</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="employee in employees" :key="employee.id">
            <td>{{ employee.id }}</td>
            <td>{{ employee.employee_name }}</td>
            <td>{{ employee.employee_age }}</td>
            <td>{{ employee.employee_salary }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        employees: [],
      };
    },
    created() {
      // this.fetchEmployees();
      this.loadEmployees();
    },
    methods: {
      // Check if data is stored in localStorage
      loadEmployees() {
        const cachedData = localStorage.getItem('employees');
        if (cachedData) {
          this.employees = JSON.parse(cachedData);
        } else {
          // No cached data is found,
          // Execute fetchEmployees() to get new data
          this.fetchEmployees();
        }
      },
      
      async fetchEmployees() {
        try {
          const response = await axios.get('https://dummy.restapiexample.com/api/v1/employees');
          this.employees = response.data.data;

          // Put API response in localStorage to prevent unnecessary API request
          localStorage.setItem('employees', JSON.stringify(this.employees));
        } catch (error) {
          // Handle error 429 by adding delay
          if (error.response && error.response.status === 429) {
            console.warn('Too many requests. Retrying in 3 seconds...');
            setTimeout(this.fetchEmployees, 3000); // Retry after 3 seconds
          } else {
            console.error('Error fetching employees:', error);
          }
        }
      },
    },
  };
  </script>
  
  <style scoped>
  /* ul {
    list-style-type: none;
    padding: 0;
  }
  li {
    padding: 8px 0;
  } */
  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
  }

  th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
  }

  th {
    background-color: #f2f2f2;
  }

  tr:nth-child(even) {
    background-color: #f9f9f9;
  }

  tr:hover {
    background-color: #f1f1f1;
  }
  </style>
  