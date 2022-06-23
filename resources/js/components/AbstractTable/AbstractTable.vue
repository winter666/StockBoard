<template>
  <div class="abstract-table">
    <el-table v-loading="isOnLoad" :data="data" row-key="id" border fit highlight-current-row style="width: 100%">
      <el-table-column
        v-for="(column, index) in columns"
        :key="index"
        :label="column.name"
        :width="column.width"
        :align="column.align"
        :min-width="column.minWidth"
      >
        <template slot-scope="scope">
          <span v-if="column.render">{{ column.render(scope.row) }}</span>
          <span v-else-if="column.renderAsHTML" v-html="column.renderAsHTML(scope.row)" />
          <span v-else>{{ scope.row[column.key] }}</span>
        </template>
      </el-table-column>
      <el-table-column v-if="withActions" width="120px" :label="$t('table.actions')" align="right">
        <template slot-scope="scope">
          <router-link v-if="actions.findIndex(a => a === action_edit) >= 0" :to="`/${target}/edit/${scope.row.id}`">
            <el-tooltip :content="$t('actions.edit')">
              <el-button type="primary" size="small" icon="el-icon-edit" />
            </el-tooltip>
          </router-link>
          <el-tooltip v-if="actions.findIndex(a => a === action_delete) >= 0" :content="$t('actions.delete')">
            <el-button type="danger" size="small" icon="el-icon-delete" @click="handleDelete(scope.row.id);" />
          </el-tooltip>
        </template>
      </el-table-column>
    </el-table>
  </div>
</template>

<script>
export default {
  name: 'AbstractTable',
  props: {
    data: { type: Array, required: true },
    withActions: { type: Boolean, required: false, default: false },
    actions: { type: Array, required: false, default: () => ['edit', 'delete'] },
    isOnLoad: { type: Boolean, required: false, default: false },
    columns: { type: Array, required: true },
    target: { type: String, required: true },
  },
  data() {
    return {
      action_edit: 'edit',
      action_delete: 'delete',
    };
  },
  methods: {
    handleDelete(id) {
      this.$confirm(`Вы уверены, что хотите позицию с ID: ${id}?`, 'Внимание', {
        confirmButtonText: 'OK',
        cancelButtonText: 'Отмена',
        type: 'warning',
      }).then(() => {
        this.$emit('delete', { id });
      }).catch(() => {
        this.$message({
          type: 'info',
          message: 'Удаление отменено',
        });
      });
    },
  },
};
</script>

<style scoped>

</style>