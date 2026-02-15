<template>
    <div class="container mt-4">
      <h2 class="mb-3">รายชื่อนักศึกษา</h2>
      
  
      <div class="mb-3 text-end">
        <button class="btn btn-primary" @click="openAddModal"> Add+ <i class="bi bi-plus-circle"></i>
        </button>
      </div>
  
      <table class="table table-bordered table-striped">
        <thead class="table-primary">
          <tr>
            <th>ID</th>
            <th>ชื่อ</th>
            <th>นามสกุล</th>
            <th>เบอร์โทร</th>
            <th>อีเมล</th>
            <th>แก้ไข/ลบ</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="student in student" :key="student.student_id">
            <td>{{ student.student_id }}</td>
            <td>{{ student.first_name }}</td>
            <td>{{ student.last_name }}</td>
            <td>{{ student.phone }}</td>
            <td>{{ student.email }}</td>
            <td>
              <button class="btn btn-warning btn-sm" @click="openEditModal(student)">
                แก้ไข
              </button>
              |
              <button class="btn btn-danger btn-sm" @click="deleteStudent(student.student_id)"> <!--ถ้าไม่ได้มาใส่ crud เพิ่มหลัง deleteStudent-->
                ลบ
              </button>
            </td>
          </tr>
        </tbody>
      </table>
  
  
      <div v-if="loading" class="text-center"><p>กำลังโหลดข้อมูล...</p></div>
      <div v-if="error" class="alert alert-danger">{{ error }}</div>
  
      <!-- ✅ Modal ใช้ทั้งเพิ่ม/แก้ไข -->
      <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">{{ isEditMode ? "แก้ไขข้อมูลนักเรียน" : "เพิ่มนักเรียนใหม่" }}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <form @submit.prevent="saveStudent">
                <div class="mb-3">
                  <label class="form-label">ชื่อ</label>
                  <input v-model="editStudent.first_name" type="text" class="form-control" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">นามสกุล</label>
                  <input v-model="editStudent.last_name" type="text" class="form-control" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">เบอร์โทร</label>
                  <input v-model="editStudent.phone" type="text" class="form-control" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">อีเมล</label>
                  <input v-model="editStudent.email" type="text" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success">
                  {{ isEditMode ? "บันทึกการแก้ไข" : "เพิ่มนักเรียน" }}
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
  
    </div>
  </template>
  
  <script>
  import { ref, onMounted } from "vue";
  
  export default {
    name: "StudentList",
    setup() {
      const student = ref([]);
      const loading = ref(true);
      const error = ref(null);
      const editStudent = ref({});
      const isEditMode = ref(false);
      let editModal = null;
  
      const fetchStudent = async () => {
        try {
          const response = await fetch("http://localhost/App-vue01/php_api/student_crud.php");
          const result = await response.json();
  
          if (result.success) {
            student.value = result.data;
          } else {
            error.value = result.message;
          }
        } catch (err) {
          error.value = err.message;
        } finally {
          loading.value = false;
        }
      };
  
      onMounted(() => {
        fetchStudent();
        const modalEl = document.getElementById("editModal");
        editModal = new window.bootstrap.Modal(modalEl);
      });
  
      // ✅ เปิด Modal เพิ่มลูกค้าใหม่
      const openAddModal = () => {
        isEditMode.value = false;
        editStudent.value = {
          first_name: "",
          last_name: "",
          phone: "",
          email: ""
        };
        editModal.show();
      };
  
      // ✅ เปิด Modal แก้ไขลูกค้า
      const openEditModal = (student) => {
        isEditMode.value = true;
        editStudent.value = { ...student, password: "" };
        editModal.show();
      };
  
      // ✅ ใช้ฟังก์ชันเดียวสำหรับทั้งเพิ่ม/แก้ไข
      const saveStudent = async () => {
        const url = "http://localhost/App-vue01/php_api/student_crud.php";
        const method = isEditMode.value ? "PUT" : "POST";
  
        try {
          const response = await fetch(url, {
            method,
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(editStudent.value)
          });
  
          const result = await response.json();
  
          if (result.success) {
            alert(result.message);
            fetchStudent();
            editModal.hide();
          } else {
            alert(result.message);
          }
        } catch (err) {
          alert("เกิดข้อผิดพลาด: " + err.message);
        }
      };
  
      // ✅ ลบลูกค้า
      const deleteStudent = async (id) => {
        if (!confirm("คุณต้องการลบข้อมูลนี้ใช่หรือไม่?")) return;
        try {
          const response = await fetch("http://localhost/App-vue01/php_api/student_crud.php", {
            method: "DELETE",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ student_id: id })
          });
          const result = await response.json();
          if (result.success) {
            student.value = student.value.filter(c => c.student_id !== id);
            alert(result.message);
          } else {
            alert(result.message);
          }
        } catch (err) {
          alert("เกิดข้อผิดพลาด: " + err.message);
        }
      };
  
      return {
        student,
        loading,
        error,
        editStudent,
        isEditMode,
        openAddModal,
        openEditModal,
        saveStudent,
        deleteStudent
      };
    }
  };
  </script>