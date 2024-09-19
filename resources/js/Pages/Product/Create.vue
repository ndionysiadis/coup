<script setup lang="ts">
import { Head } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import HeadingLarge from "@/Components/Texts/HeadingLarge.vue";
import Breadcrumb from "@/Components/Pagination/Breadcrumb.vue";
import Breadcrumbs from "@/Components/Pagination/Breadcrumbs.vue";
import IconSecondaryButton from "@/Components/Buttons/IconSecondaryButton.vue";
import {
    PhArrowUUpLeft,
    PhCurrencyEur,
    PhFloppyDiskBack,
} from "@phosphor-icons/vue";
import AppLink from "@/Components/Links/AppLink.vue";
import { useForm } from "laravel-precognition-vue-inertia";
import FormInput from "@/Components/FormElements/FormInput.vue";
import CardContainer from "@/Components/Cards/CardContainer.vue";
import PrimaryButtonIcon from "@/Components/Buttons/PrimaryButtonIcon.vue";
import FormNumber from "@/Components/FormElements/FormNumber.vue";
import Combobox from "@/Components/Selectors/Combobox.vue";
import { ref } from "vue";
import axios from "axios";

const props = defineProps<{
    product: App.Data.ProductData;
}>();

const title = "Δημιουργία προϊόντος";

const categories = ref<Array<any>>([]);
const loading = ref<boolean>(true);

const fetchCategories = async () => {
    try {
        if (categories.value.length === 0) {
            const response = await axios.get("/api/categories");
            categories.value = response.data;
        }
    } finally {
        loading.value = false;
    }
};

const form = useForm<App.Data.ProductData>(
    "post",
    route("product.store"),
    props.product,
);
const handleSelectedCategories = (selectedCategories: any[]) => {
    if (selectedCategories.length > 0) {
        const selectedCategory = categories.value.find(
            (category) => category.name === selectedCategories[0],
        );
        if (selectedCategory) {
            form.categoryId = selectedCategory.id;
            console.log("Selected category ID:", selectedCategory.id);
        }
    } else {
        form.categoryId = null;
    }
};
</script>

<template>
    <Head :title="title" />

    <AuthenticatedLayout>
        <template #breadcrumbs>
            <Breadcrumbs>
                <Breadcrumb first :href="route('product.index')">
                    Προϊόντα
                </Breadcrumb>

                <Breadcrumb :href="route('product.create')">
                    Δημιουργία
                </Breadcrumb>
            </Breadcrumbs>
        </template>

        <div class="mb-4 flex items-center justify-between">
            <div class="flex flex-col">
                <HeadingLarge> {{ title }}</HeadingLarge>
            </div>

            <div class="flex items-center gap-2">
                <AppLink :href="route('product.index')">
                    <IconSecondaryButton title="Επιστροφή">
                        <PhArrowUUpLeft weight="bold" />
                    </IconSecondaryButton>
                </AppLink>
            </div>
        </div>

        <form @submit.prevent="form.submit()">
            <CardContainer class="flex flex-col gap-4">
                <FormInput
                    id="text"
                    type="text"
                    label="Όνομα"
                    :required="true"
                    :autofocus="false"
                    :error="form.errors.name"
                    v-model="form.name"
                />

                <FormInput
                    id="description"
                    type="text"
                    label="Περιγραφή"
                    :required="false"
                    :autofocus="false"
                    :error="form.errors.description"
                    v-model="form.description"
                />

                <FormNumber
                    id="price"
                    step="0.1"
                    label="Τιμή"
                    :required="false"
                    :autofocus="false"
                    :error="form.errors.price"
                    v-model="form.price"
                >
                    <PhCurrencyEur weight="bold" />
                </FormNumber>

                <Combobox
                    id="selectCategories"
                    type="string"
                    displayField="name"
                    :options="categories"
                    label="Κατηγορία"
                    @click="fetchCategories"
                    @update:selectedOptions="handleSelectedCategories"
                />

                <div>
                    <PrimaryButtonIcon type="submit" title="Αποθήκευση">
                        <template #icon>
                            <PhFloppyDiskBack weight="fill" size="16" />
                        </template>
                        Αποθήκευση
                    </PrimaryButtonIcon>
                </div>
            </CardContainer>
        </form>
    </AuthenticatedLayout>
</template>
