<template>
  <div class="container mt-4">
    <h2 class="mb-3">รายการประเภท</h2>
    
    <div class="mb-3">
      <button class="btn btn-primary" type="button" @click="openAddModal">
        Add <i class="bi bi-plus-circle"></i>
      </button>
    </div>

    <table class="table table-bordered table-striped">
      <thead class="table-primary">
        <tr>
          <th>ID</th>
          <th>ชื่อประเภท</th>
          <th>แก้ไข</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="types in types" :key="types.type_id">
          <td>{{ types.type_id }}</td>
          <td>{{ types.type_name }}</td>
          <td>
            <button class="btn btn-warning btn-sm" @click="openEditModal(types)">
              แก้ไข
            </button>
            |
            <button class="btn btn-danger btn-sm" @click="deleteTypes(types.type_id)">
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
            <h5 class="modal-title">{{ isEditMode ? "แก้ไขข้อมูลประเภท" : "เพิ่มประเภทใหม่" }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="saveTypes">
              <div class="mb-3">
                <label class="form-label">ชื่อประเภท</label>
                <input v-model="editTypes.type_name" type="text" class="form-control" required>
              </div>
              <button type="submit" class="btn btn-success">
                {{ isEditMode ? "บันทึกการแก้ไข" : "เพิ่มลูกค้า" }}
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
  name: "TypeList",
  setup() {
    const types = ref([]);
    const loading = ref(true);
    const error = ref(null);
    const editTypes = ref({});
    const isEditMode = ref(false);
    let editModal = null;

    const fetchType = async () => {
      try {
        const response = await fetch("http://localhost/App-vue01/php_api/type_crud.php");
        const result = await response.json();

        if (result.success) {
          types.value = result.data;
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
      fetchType();
      const modalEl = document.getElementById("editModal");
      editModal = new window.bootstrap.Modal(modalEl);
    });

    // ✅ เปิด Modal เพิ่มลูกค้าใหม่
    const openAddModal = () => {
      isEditMode.value = false;
      editTypes.value = {
        type_name: "",
      };
      editModal.show();
    };

    // ✅ เปิด Modal แก้ไขลูกค้า
    const openEditModal = (types) => {
      isEditMode.value = true;
      editTypes.value = { ...types, password: "" };
      editModal.show();
    };

    // ✅ ใช้ฟังก์ชันเดียวสำหรับทั้งเพิ่ม/แก้ไข
    const saveTypes = async () => {
      const url = "http://localhost/App-vue01/php_api/type_crud.php";
      const method = isEditMode.value ? "PUT" : "POST";

      try {
        const response = await fetch(url, {
          method,
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify(editTypes.value)
        });

        const result = await response.json();

        if (result.success) {
          alert(result.message);
          fetchType();
          editModal.hide();
        } else {
          alert(result.message);
        }
      } catch (err) {
        alert("เกิดข้อผิดพลาด: " + err.message);
      }
    };

    // ✅ ลบลูกค้า
    const deleteTypes = async (id) => {
      if (!confirm("คุณต้องการลบข้อมูลนี้ใช่หรือไม่?")) return;
      try {
        const response = await fetch("http://localhost/App-vue01/php_api/type_crud.php", {
          method: "DELETE",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({ type_id: id })
        });
        const result = await response.json();
        if (result.success) {
          types.value = types.value.filter(c => c.type_id !== id);
          alert(result.message);
        } else {
          alert(result.message);
        }
      } catch (err) {
        alert("เกิดข้อผิดพลาด: " + err.message);
      }
    };

    return {
      types,
      loading,
      error,
      editTypes,
      isEditMode,
      openAddModal,
      openEditModal,
      saveTypes,
      deleteTypes
    };
  }
};
</script>
