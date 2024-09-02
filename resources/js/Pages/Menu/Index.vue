<script setup lang="ts">
import {Head} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import HeadingLarge from "@/Components/Texts/HeadingLarge.vue";
import PaginationMeta from "@/Components/Pagination/PaginationMeta.vue";
import MenuCard from "@/Models/MenuCard.vue";
import PaginationLinks from "@/Components/Pagination/PaginationLinks.vue";
import Breadcrumb from "@/Components/Pagination/Breadcrumb.vue";
import Breadcrumbs from "@/Components/Pagination/Breadcrumbs.vue";
import AppLink from "@/Components/Links/AppLink.vue";
import PrimaryButtonIcon from "@/Components/Buttons/PrimaryButtonIcon.vue";
import {PhPlus} from "@phosphor-icons/vue";

const title = "Menu's"

const props = defineProps<{
    menuTypes: LaravelPaginator<App.Data.MenuTypeData>
}>()
</script>

<template>
    <Head :title="title"/>

    <AuthenticatedLayout>
        <template #breadcrumbs>
            <Breadcrumbs>
                <Breadcrumb first :href="route('menu.index')">
                    Menu's
                </Breadcrumb>
            </Breadcrumbs>
        </template>

        <div class="flex items-center justify-between mb-4">
            <div class="flex flex-col">
                <HeadingLarge>{{ title }}</HeadingLarge>
                <PaginationMeta :meta="menuTypes.meta"/>
            </div>

            <div class="flex items-center gap-2">
                <AppLink :href="route('menu.create')">
                    <PrimaryButtonIcon direction="right">
                        <template #icon>
                            <PhPlus weight="bold" size="16"/>
                        </template>

                        Δημιουργία
                    </PrimaryButtonIcon>
                </AppLink>

                <PaginationLinks
                    v-if="menuTypes?.meta?.total > 0"
                    :links="menuTypes.links"/>
            </div>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-2">
            <MenuCard
                v-for="menuType in menuTypes.data"
                :key="menuType.id"
                :menu-type="menuType"/>
        </div>
    </AuthenticatedLayout>
</template>
