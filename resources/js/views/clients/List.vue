<template>
  <div class="app-container">
    <AbstractTable
      :data="clients"
      :is-on-load="load"
      :target="'clients'"
      :with-actions="true"
      :columns="[
        { key: 'first_name', name: 'Имя' },
        { key: 'last_name', name: 'Фамилия' },
        { key: 'email', name: 'E-mail' },
        { key: 'email_verified_at', name: 'E-mail подтвержден', render: (c) => (new Date(c.email_verified_at)).toUTCString() },
      ]"
      @delete="deleteClient"
    />
    <pagination
      v-show="query.total > 0"
      :total="query.total"
      :page.sync="query.page"
      :limit.sync="query.limit"
      @pagination="fetchClients"
    />
  </div>
</template>

<script>
import AbstractTable from '@/components/AbstractTable/AbstractTable';
import pagination from '@/components/Pagination';
import ClientResource from '@/api/client';

export default {
  name: 'ClientList',
  components: { AbstractTable, pagination },
  data() {
    return {
      load: false,
      query: {
        total: 0,
        page: 1,
        limit: 10,
      },
      clients: [],
    };
  },
  created() {
    this.fetchClients();
  },
  methods: {
    async deleteClient(payload) {
      this.load = true;
      try {
        await (new ClientResource()).destroy(payload.id);
        await this.fetchClients();
      } catch (e) {
        console.log(e);
      } finally {
        this.load = false;
      }
    },
    async fetchClients() {
      this.load = true;
      try {
        const { data, meta } = await (new ClientResource()).list(this.query);
        this.clients = data;
        this.query.page = parseInt(meta.current_page);
        this.query.total = parseInt(meta.total);
        this.query.limit = parseInt(meta.per_page);
      } catch (e) {
        console.log(e);
      } finally {
        this.load = false;
      }
    },
  },
};
</script>

<style scoped>

</style>
