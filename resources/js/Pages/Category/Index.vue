<script setup lang="ts">
import { Head, router } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import HeadingLarge from "@/Components/Texts/HeadingLarge.vue";
import PaginationMeta from "@/Components/Pagination/PaginationMeta.vue";
import PaginationLinks from "@/Components/Pagination/PaginationLinks.vue";
import Breadcrumb from "@/Components/Pagination/Breadcrumb.vue";
import Breadcrumbs from "@/Components/Pagination/Breadcrumbs.vue";
import AppLink from "@/Components/Links/AppLink.vue";
import { PhPlus } from "@phosphor-icons/vue";
import CategoryCard from "@/Models/CategoryCard.vue";
import IconPrimaryButton from "@/Components/Buttons/IconPrimaryButton.vue";
import { ref, watch } from "vue";
import debounce from "lodash/debounce";
import FormSearch from "@/Components/FormElements/FormSearch.vue";

const title = "Κατηγορίες";

const props = defineProps<{
    categories: LaravelPaginator<App.Data.Category.CategoryData>;
    term: App.Data.Category.CategoryIndexPageData;
}>();

const term = ref<string>(props.term!);

watch(
    term,
    debounce((value) => {
        let fullUrl: string = window.location.href;
        let url: URL = new URL(fullUrl);
        let params: URLSearchParams = new URLSearchParams(url.search);

        params.set("term", value);

        url.search = params.toString();
        router.get(
            url.href,
            {},
            {
                preserveState: true,
                only: ["categories"],
            },
        );
    }, 1000),
);
</script>

<template>
    <Head :title="title" />

    <AuthenticatedLayout>
        <template #breadcrumbs>
            <Breadcrumbs>
                <Breadcrumb first :href="route('category.index')">
                    Κατηγορίες
                </Breadcrumb>
            </Breadcrumbs>
        </template>
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <div class="flex flex-col">
                    <HeadingLarge>{{ title }}</HeadingLarge>
                    <PaginationMeta :meta="categories.meta" />
                </div>

                <div class="flex items-center gap-2">
                    <PaginationLinks
                        v-if="categories?.meta?.total > 0"
                        :links="categories.links"
                    />

                    <AppLink
                        :href="route('category.create')"
                        title="Δημιουργία"
                    >
                        <IconPrimaryButton>
                            <PhPlus weight="bold" size="16" />
                        </IconPrimaryButton>
                    </AppLink>
                </div>
            </div>

            <FormSearch :clear-route="route('category.index')" v-model="term" />

            <div class="flex flex-col gap-2">
                <CategoryCard
                    v-for="category in categories.data"
                    :key="category.id"
                    :category="category"
                />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
