<template lang="">
  <div class="container">
    <div class="contact">
      <h1>Mr. Somboon Samaiklang</h1>
      <h2>bootstrap class</h2>
      <h3>Tel. 065-959-7973</h3>

      <div class="container mt-3">
        <div class="row">
          <div class="col-sm-6 text-center">
            <img
              alt="Vue logo"
              class="object-fit-sm-contain border rounded"
              width="90%"
              src="../assets/Myimg.jpg"
            />
          </div>

          <div class="col-sm-6 bg-secondary bg-opacity-50">
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label"
                >Email address</label
              >
              <input
                type="email"
                class="form-control"
                id="exampleFormControlInput1"
                placeholder="name@example.com"
              />
            </div>
            <div class="mb-3">
              <label for="exampleFormControlTextarea1" class="form-label"
                >Example textarea</label
              >
              <textarea
                class="form-control"
                id="exampleFormControlTextarea1"
                rows="3"
              ></textarea>
            </div>

            <div style="grid-template-columns: 1fr 1fr;" class="d-grid gap-3 text-center">
              <button type="button" class="btn btn-primary">ตกลง</button>
              <button type="button" class="btn btn-danger">ยกเลิก</button>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
