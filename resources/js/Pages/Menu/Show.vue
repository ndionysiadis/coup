<script setup lang="ts">
import {Head} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import HeadingLarge from "@/Components/Texts/HeadingLarge.vue";
import Breadcrumb from "@/Components/Pagination/Breadcrumb.vue";
import Breadcrumbs from "@/Components/Pagination/Breadcrumbs.vue";
import {formatTitleCase} from "@/Shared/globalFunctions";
import IconSecondaryButton from "@/Components/Buttons/IconSecondaryButton.vue";
import {PhPencilSimple} from "@phosphor-icons/vue";
import CategoryCard from "@/Models/CategoryCard.vue";
import AppLink from "@/Components/Links/AppLink.vue";

const props = defineProps<{
    menuType: App.Data.MenuTypeData
}>()

const title = formatTitleCase(props.menuType.name)
</script>

<template>
    <Head :title="title"/>

    <AuthenticatedLayout>
        <template #breadcrumbs>
            <Breadcrumbs>
                <Breadcrumb first :href="route('menu.index')">
                    Menu's
                </Breadcrumb>

                <Breadcrumb :href="route('menu.show', menuType)">
                    {{ title }}
                </Breadcrumb>
            </Breadcrumbs>
        </template>

        <div class="flex items-center justify-between mb-4">
            <div class="flex flex-col">
                <HeadingLarge> {{ title }}</HeadingLarge>
            </div>

            <AppLink :href="route('menu.edit', menuType)">
                <IconSecondaryButton title="Επεξεργασία">
                    <PhPencilSimple weight="fill"/>
                </IconSecondaryButton>
            </AppLink>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-2">
            <CategoryCard v-for="category in menuType.categories"
                          :key="category.id"
                          :category="category"/>
        </div>

    </AuthenticatedLayout>
</template>
