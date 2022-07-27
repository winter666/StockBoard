<template>
  <div class="app-container">
    <AbstractTable
      :is-on-load="load"
      :data="list"
      :target="'sync'"
      :columns="[
        { name: 'Название интеграции', key: 'name' },
        { name: 'Статус', key: 'status', tag: { getType: (row) => statuses[row.status] } },
        { name: 'Время начала', key: 'created_at', render: (row) => (new Date(row.created_at)).toUTCString() },
        { name: 'Время окончания', key: 'updated_at', render: (row) => (new Date(row.updated_at)).toUTCString() },
      ]"
    />
    <pagination
      v-show="query.total > 0"
      :total="query.total"
      :page.sync="query.page"
      :limit.sync="query.limit"
      @pagination="fetchSyncronizrion"
    />
  </div>
</template>

<script>
import AbstractTable from '@/components/AbstractTable/AbstractTable';
import SyncResource from '@/api/sync';
import pagination from '@/components/Pagination';
export default {
  name: 'IntegrationLogs',
  components: { AbstractTable, pagination },
  data() {
    return {
      list: [],
      query: {
        total: 0,
        page: 1,
        limit: 10,
      },
      load: true,
      statuses: {
        COMPLETED: 'success',
        IN_PROGRESS: 'warning',
        FAILED: 'danger',
      },
    };
  },
  created() {
    this.fetchSyncronizrion();
  },
  methods: {
    async fetchSyncronizrion() {
      try {
        const { data } = await (new SyncResource()).list(this.query);
        this.list = data.data;
        this.query.page = parseInt(data.current_page);
        this.query.total = parseInt(data.total);
        this.query.limit = parseInt(data.per_page);
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
