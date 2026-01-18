<template>
  <div class="container mt-4">
    <h2 class="mb-3">รายการประเภทสินค้า</h2>
    
    <!-- ตารางแสดงข้อมูลลูกค้า -->
    <table class="table table-bordered table-striped">
      <thead class="table-dark">
        <tr>
          <th>รหัสพนักงาน</th>
          <th>ชื่อพนักงาน</th>
          <th>แผนก</th>
          <th>เงินเดือน</th>
          <th>สถานะ</th>
          <th>วันที่สร้าง</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(employees) in employees" :key="employees.emp_id">
          <td>{{ employees.emp_id }}</td>
          <td>{{ employees.full_name }}</td>
          <td>{{ employees.department }}</td>
          <td>{{ employees.salary }}</td>
          <td>{{ employees.active }}</td>
          <td>{{ employees.created_at }}</td>
        </tr>
      </tbody>
    </table>

    <!-- Loading -->
    <div v-if="loading" class="text-center">
      <p>กำลังโหลดข้อมูล...</p>
    </div>

    <!-- Error -->
    <div v-if="error" class="alert alert-danger">
      {{ error }}
    </div>
  </div>
</template>

<script>
import { ref, onMounted } from "vue";

export default {
  name: "TypeList",
  setup() {
    const employees = ref([]);
    const loading = ref(true);
    const error = ref(null);

    // ฟังก์ชันดึงข้อมูลจาก API
    const fetchEmployees = async () => {
      try {
        const response = await fetch("http://localhost/app-vue01/php_api/show_employee.php");
        if (!response.ok) {
          throw new Error("ไม่สามารถดึงข้อมูลได้");
        }
        employees.value = await response.json();
      } catch (err) {
        error.value = err.message;
      } finally {
        loading.value = false;
      }
    };

    onMounted(() => {
      fetchEmployees();
    });

    return {
      employees: employees,
      loading,
      error
    };
  }
};
</script>
