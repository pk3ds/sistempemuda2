<script>
import { Head, Link } from "@inertiajs/inertia-vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import SearchFilter from "@/Components/SearchFilter.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import Pagination from "@/Components/Pagination.vue";
import pickBy from "lodash/pickBy";
import throttle from "lodash/throttle";

export default {
  components: {
    Head,
    Link,
    AuthenticatedLayout,
    SearchFilter,
    PrimaryButton,
    SecondaryButton,
    DangerButton,
    Pagination,
  },
  props: {
    filters: Object,
    roles: Object,
  },
  setup() {
    console.log("setup");
  },
  data() {
    return {
      form: {
        search: this.filters.search,
      },
    };
  },
  watch: {},
  methods: {
    log() {
      console.log(this.roles);
    },
    getPermission(role) {
      let permission = "-";
      if (role.permissions.length > 0) {
        permission = "";
        role.permissions.map((rolePermission) => {
          permission = permission
            ? `${permission}, ${rolePermission.name}`
            : `${rolePermission.name}`;
        });
      }
      return permission;
    },
  },
};
</script>

<template>
  <Head title="Users" />

  <AuthenticatedLayout :auth="$page.props.auth">
    <div class="pt-8 pb-2">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            <div class="lg:px-6 flex justify-between border-b pb-2">
              <h4 class="text-lg mt-2 mr-2">Roles</h4>
              <SearchFilter v-model="form.search" class="mr-4 w-full max-w-md">
              </SearchFilter>
              <PrimaryButton>
                <Link :href="route('roles.create')">Add</Link>
              </PrimaryButton>
            </div>
            <div class="flex flex-col">
              <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                  <div class="overflow-hidden">
                    <table class="min-w-full">
                      <thead class="bg-white border-b">
                        <tr>
                          <th
                            scope="col"
                            class="text-sm font-medium text-gray-900 px-6 py-4 text-left"
                          >
                            Name
                          </th>
                          <th
                            scope="col"
                            class="text-sm font-medium text-gray-900 px-6 py-4 text-left"
                          >
                            Permission
                          </th>
                          <th
                            scope="col"
                            class="text-sm font-medium text-gray-900 px-6 py-4 text-left"
                          >
                            Action
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr
                          v-for="role in roles.data"
                          class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100"
                        >
                          <td
                            class="text-sm text-gray-900 font-light px-6 py-4"
                          >
                            <Link :href="route('roles.edit', role)">{{
                              role.name
                            }}</Link>
                          </td>
                          <td
                            class="text-sm text-gray-900 font-light px-6 py-4"
                          >
                            {{ getPermission(role) }}
                          </td>
                          <td
                            class="text-sm text-gray-900 font-light px-6 py-4"
                          >
                            <DangerButton
                              class="mx-1"
                              @click="getPermission(role)"
                            >
                              test
                            </DangerButton>
                            <SecondaryButton class="mx-1">
                              <Link :href="route('roles.edit', role)">
                                View
                              </Link>
                            </SecondaryButton>
                            <DangerButton
                              class="mx-1"
                              @click="deleteItem(role)"
                            >
                              Delete
                            </DangerButton>
                          </td>
                        </tr>
                        <tr v-if="roles.data.length === 0">
                          <td
                            class="px-6 py-4 border-t text-center"
                            colspan="6"
                          >
                            No roles found.
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <Pagination
                    class="mt-6"
                    :links="roles.links"
                    :from="roles.from"
                    :to="roles.to"
                    :total="roles.total"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
