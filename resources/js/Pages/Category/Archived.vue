<script setup lang="ts">
import { Head, router } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import HeadingLarge from "@/Components/Texts/HeadingLarge.vue";
import PaginationMeta from "@/Components/Pagination/PaginationMeta.vue";
import PaginationLinks from "@/Components/Pagination/PaginationLinks.vue";
import Breadcrumb from "@/Components/Pagination/Breadcrumb.vue";
import Breadcrumbs from "@/Components/Pagination/Breadcrumbs.vue";
import AppLink from "@/Components/Links/AppLink.vue";
import { PhArrowLeft, PhListBullets } from "@phosphor-icons/vue";
import { ref, watch } from "vue";
import debounce from "lodash/debounce";
import FormSearch from "@/Components/FormElements/FormSearch.vue";
import IconSecondaryButton from "@/Components/Buttons/IconSecondaryButton.vue";
import EmptyState from "@/Components/EmptyStates/EmptyState.vue";
import ArchiveCategoryCard from "@/Models/ArchiveCategoryCard.vue";

const title = "Αρχείο";

const props = defineProps<{
    categories: LaravelPaginator<App.Data.Category.CategoryData>;
    term: App.Data.Category.CategoryIndexPageData;
}>();

//@ts-ignore
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
                only: ["menuTypes"],
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

                <Breadcrumb :href="route('category.archived')">
                    Αρχείο
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

                    <AppLink :href="route('category.index')" title="Επιστροφή">
                        <IconSecondaryButton>
                            <PhArrowLeft weight="bold" size="16" />
                        </IconSecondaryButton>
                    </AppLink>
                </div>
            </div>

            <template v-if="categories.meta.total > 0">
                <FormSearch
                    :clear-route="route('category.archived')"
                    v-model="term"
                />

                <div class="flex flex-col gap-2">
                    <ArchiveCategoryCard
                        v-for="category in categories.data"
                        :key="category.id!"
                        :category="category"
                    />
                </div>
            </template>

            <EmptyState v-else>
                <template #icon>
                    <PhListBullets size="44" />
                </template>
                <template #content>
                    Φαίνεται πως δεν υπάρχουν αρχειοθετημένες κατηγορίες
                </template>
            </EmptyState>
        </div>
    </AuthenticatedLayout>
</template>
