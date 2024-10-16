<script setup lang="ts">
import { Head, router } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import HeadingLarge from "@/Components/Texts/HeadingLarge.vue";
import Breadcrumb from "@/Components/Pagination/Breadcrumb.vue";
import Breadcrumbs from "@/Components/Pagination/Breadcrumbs.vue";
import IconSecondaryButton from "@/Components/Buttons/IconSecondaryButton.vue";
import {
    PhArrowUUpLeft,
    PhListBullets,
    PhPencilSimple,
    PhTrash,
    PhWarningCircle,
} from "@phosphor-icons/vue";
import AppLink from "@/Components/Links/AppLink.vue";
import CardContainer from "@/Components/Cards/CardContainer.vue";
import { ref } from "vue";
import PrimaryModal from "@/Components/Modals/PrimaryModal.vue";
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/Buttons/SecondaryButton.vue";
import TextLink from "@/Components/Links/TextLink.vue";
import ImageCard from "@/Components/Cards/ImageCard.vue";

const props = defineProps<{
    product: App.Data.Product.ProductData;
}>();

const modalOpen = ref<boolean>(false);

const title = props.product.name;

function destroy() {
    router.delete(route("product.destroy", props.product), {
        preserveState: true,
        preserveScroll: true,
        only: ["toast"],
    });
}
</script>

<template>
    <Head :title="title" />

    <AuthenticatedLayout>
        <template #breadcrumbs>
            <Breadcrumbs>
                <Breadcrumb first :href="route('product.index')">
                    Προϊόντα
                </Breadcrumb>

                <Breadcrumb :href="route('product.show', product)">
                    {{ title }}
                </Breadcrumb>
            </Breadcrumbs>
        </template>
        <div class="space-y-4">
            <div
                class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between"
            >
                <div class="flex flex-col">
                    <HeadingLarge>
                        {{ title }} <span v-if="product.price">-</span>
                        {{ product.price
                        }}<span v-if="product.price"
                            >&#8364;</span
                        ></HeadingLarge
                    >
                </div>

                <div class="flex items-center gap-2">
                    <AppLink :href="route('product.index')">
                        <IconSecondaryButton title="Επιστροφή">
                            <PhArrowUUpLeft weight="bold" />
                        </IconSecondaryButton>
                    </AppLink>

                    <AppLink :href="route('product.edit', product)">
                        <IconSecondaryButton title="Επεξεργασία">
                            <PhPencilSimple weight="fill" />
                        </IconSecondaryButton>
                    </AppLink>

                    <IconSecondaryButton
                        title="Διαγραφή"
                        @click="modalOpen = !modalOpen"
                    >
                        <PhTrash weight="fill" />
                    </IconSecondaryButton>
                </div>

                <PrimaryModal :open="modalOpen" @closeModal="modalOpen = false">
                    <template #icon>
                        <PhWarningCircle weight="bold" size="24" />
                    </template>

                    <template #title>
                        Διαγραφή προϊόντος: {{ props.product.name }}
                    </template>

                    <template #body>
                        Είστε σίγουροι ότι θέλετε να διαγράψετε το συγκεκριμένο
                        προϊόν; Η διαγραφή θα γίνει μόνο στο προϊόν και όχι
                        στους συνδεδεμένους καταλόγους & κατηγορίες.
                    </template>

                    <template #actions>
                        <SecondaryButton @click="modalOpen = false">
                            Άκυρο
                        </SecondaryButton>

                        <DangerButton @click="destroy"> Διαγραφή </DangerButton>
                    </template>
                </PrimaryModal>
            </div>

            <CardContainer class="mb-4 flex flex-col gap-2">
                <div v-if="product.category" class="flex items-center gap-1">
                    <PhListBullets size="16" weight="bold" />
                    <TextLink :href="route('category.show', product.category)">
                        {{ product.category.name }}
                    </TextLink>
                </div>

                <div>
                    {{ product.description }}
                </div>

                <ImageCard
                    v-if="product.image"
                    class="w-96"
                    :image-url="product.image"
                    :alt-text="product.name"
                />
            </CardContainer>
        </div>
    </AuthenticatedLayout>
</template>
