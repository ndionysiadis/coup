<script setup lang="ts">
import { Head, router } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import HeadingLarge from "@/Components/Texts/HeadingLarge.vue";
import PaginationMeta from "@/Components/Pagination/PaginationMeta.vue";
import PaginationLinks from "@/Components/Pagination/PaginationLinks.vue";
import Breadcrumb from "@/Components/Pagination/Breadcrumb.vue";
import Breadcrumbs from "@/Components/Pagination/Breadcrumbs.vue";
import AppLink from "@/Components/Links/AppLink.vue";
import { PhArchive, PhListBullets, PhPlus } from "@phosphor-icons/vue";
import CategoryCard from "@/Models/CategoryCard.vue";
import IconPrimaryButton from "@/Components/Buttons/IconPrimaryButton.vue";
import { ref, watch, computed } from "vue";
import debounce from "lodash/debounce";
import FormSearch from "@/Components/FormElements/FormSearch.vue";
import SecondaryButtonIcon from "@/Components/Buttons/SecondaryButtonIcon.vue";
import Draggable from "vuedraggable";
import EmptyState from "@/Components/EmptyStates/EmptyState.vue";
import PrimaryButtonIcon from "@/Components/Buttons/PrimaryButtonIcon.vue";

const title = "Κατηγορίες";

const props = defineProps<{
    categories: LaravelPaginator<App.Data.Category.CategoryData>;
    term: App.Data.Category.CategoryIndexPageData;
}>();

//@ts-ignore
const term = ref<string>(props.term!);
const items = ref(props.categories.data);
const isDragging = ref(false);

watch(
    () => props.categories,
    (newCategories) => {
        if (!isDragging.value) {
            items.value = newCategories.data;
        }
    },
    { deep: true },
);

const draggableEnabled = computed(() => {
    return !term.value && items.value.length > 0;
});

const handleSearch = debounce((value: string) => {
    let url = new URL(window.location.href);
    let params = new URLSearchParams(url.search);

    if (value) {
        params.set("term", value);
    } else {
        params.delete("term");
    }

    url.search = params.toString();
    router.get(
        url.href,
        {},
        {
            preserveState: true,
            preserveScroll: true,
            only: ["categories"],
        },
    );
}, 300);

watch(term, handleSearch);

function reorder() {
    if (!term.value) {
        isDragging.value = true;
        router.post(
            route("category.reorder", { category: items.value[0].id }),
            {
                options: items.value.map((item) => ({ id: item.id })),
            },
            {
                onSuccess: () => {
                    isDragging.value = false;
                },
                onError: () => {
                    isDragging.value = false;
                    items.value = props.categories.data;
                },
            },
        );
    }
}
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

                    <AppLink :href="route('category.archived')" title="Αρχείο">
                        <SecondaryButtonIcon>
                            <template #icon>
                                <PhArchive weight="fill" size="16" />
                            </template>
                            Αρχείο
                        </SecondaryButtonIcon>
                    </AppLink>
                </div>
            </div>

            <template v-if="categories.meta.total > 0">
                <FormSearch
                    :clear-route="route('category.index')"
                    v-model="term"
                />

                <Draggable
                    v-model="items"
                    item-key="id"
                    @change="reorder"
                    :animation="200"
                    ghost-class="ghost"
                    drag-class="drag"
                    class="flex flex-col gap-2"
                    :disabled="!draggableEnabled"
                >
                    <template #item="{ element }">
                        <CategoryCard
                            :is-draggable="draggableEnabled"
                            :key="element.id!"
                            :category="element"
                            class="transition-all duration-300 ease-in-out"
                        />
                    </template>
                </Draggable>
            </template>

            <EmptyState v-else>
                <template #icon>
                    <PhListBullets size="44" />
                </template>
                <template #content>
                    Φαίνεται πως δεν υπάρχουν ενεργές κατηγορίες
                </template>
                <template #action>
                    <AppLink
                        :href="route('category.create')"
                        title="Δημιουργία"
                    >
                        <PrimaryButtonIcon>
                            <template #icon>
                                <PhPlus weight="bold" size="16" />
                            </template>
                            Προσθήκη
                        </PrimaryButtonIcon>
                    </AppLink>
                </template>
            </EmptyState>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
.ghost {
    opacity: 0.5;
    background: #c8ebfb;
}

.drag {
    opacity: 0.8;
    transform: scale(1.05);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}
</style>
