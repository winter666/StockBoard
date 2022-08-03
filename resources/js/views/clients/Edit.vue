<template>
  <div class="app-container">
    <el-form>
      <el-form-item label="Имя" required :error="errors.first_name">
        <el-input v-model="form.first_name" />
      </el-form-item>
      <el-form-item label="Фамилия" required :error="errors.last_name">
        <el-input v-model="form.last_name" />
      </el-form-item>
      <el-form-item label="E-mail" required :error="errors.email">
        <el-input v-model="form.email" />
      </el-form-item>
      <el-form-item label="E-mail подтвержден" :error="errors.email_verified_at">
        <el-date-picker v-model="form.email_verified_at" />
      </el-form-item>
      <div v-if="!wasCreated">
        <el-form-item label="Пароль" required :error="errors.password">
          <el-input v-model="createForm.password" type="password" @change="comparePass" />
        </el-form-item>
        <el-form-item label="Подтверждение пароля" required :error="errors.password_confirmation">
          <el-input v-model="createForm.password_confirmation" type="password" @change="comparePass" />
        </el-form-item>
      </div>
      <el-form-item>
        <el-button icon="el-icon-edit" type="success" @click="save">Сохранить</el-button>
      </el-form-item>
    </el-form>
    <Loader :active="load" />
  </div>
</template>

<script>
import ClientResource from '@/api/client';
import Loader from '@/components/Loader/Loader';

export default {
  name: 'ClientEdit',
  components: { Loader },
  data() {
    return {
      id: null,
      wasCreated: false,
      load: true,
      form: {
        first_name: null,
        last_name: null,
        email: null,
        email_verified_at: null,
      },
      createForm: {
        password: null,
        password_confirmation: null,
      },
      errors: {
        first_name: '',
        last_name: '',
        email: '',
        email_verified_at: '',
        password: '',
        password_confirmation: '',
      },
    };
  },
  created() {
    this.id = this.$route.params.id ?? null;
    if (this.id) {
      this.wasCreated = true;
      this.fetchData();
    } else {
      this.load = false;
    }
  },
  methods: {
    async fetchData() {
      this.load = true;
      try {
        const { data } = await (new ClientResource()).get(this.id);
        for (const field in data) {
          if (this.form.hasOwnProperty(field)) {
            this.form[field] = data[field];
          }
        }
        console.log(data);
      } catch (e) {
        console.log(e);
      } finally {
        this.load = false;
      }
    },
    async save() {
      this.load = true;
      try {
        const clientResource = new ClientResource();
        if (this.wasCreated) {
          await clientResource.update(this.id, this.form);
        } else {
          await clientResource.store({ ...this.form, ...this.createForm });
        }

        this.$message({
          type: 'success',
          message: 'Успешно сохранено',
        });
        this.$router.push({ name: 'ClientsList' });
      } catch (e) {
        console.log(e);
      } finally {
        this.load = false;
      }
    },
    comparePass() {
      if (this.createForm.password !== this.createForm.password_confirmation) {
        this.errors.password_confirmation = 'Пароли не совпадают';
      } else {
        this.errors.password_confirmation = '';
      }
    },
  },
};
</script>

<style scoped>

</style>
