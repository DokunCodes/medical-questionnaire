<script>
import { ChevronDownIcon, ChevronUpIcon } from '@heroicons/vue/24/solid';
import { TrashIcon} from "@heroicons/vue/24/solid";
import { PencilIcon } from "@heroicons/vue/24/solid";


export default {
    components: {
        ChevronDownIcon,
        ChevronUpIcon,
        TrashIcon,
        PencilIcon
    },
    props: {
        questions: Array,
    },
    mounted() {
      //  console.log(this.questions);
       console.log(this.$page.props.flash);
    },
    methods: {

        toggleOptions(question) {
            if (this.currentExpandedQuestion) {
                this.currentExpandedQuestion.showOptions = false;
            }

            if (this.currentExpandedQuestion === question) {
                this.currentExpandedQuestion = null;
            } else {
                question.showOptions = !question.showOptions;
                this.currentExpandedQuestion = question;
            }
        },
        async deleteQuestion(question) {

            if (!confirm('Are you sure you want to delete this question and its associated options / recommendation ?')) {
                return;
            }

            await this.$inertia.post(`/questions/${question.id}/delete`, {},{
                onSuccess: (data) => {
                    this.error = data.props.flash.error || null;
                    this.message = data.props.flash.message || null;
                },
                onError: (data) => {
                    console.log(data);
                }
            })

            const index = this.questions.findIndex(q => q.id === question.id);
            if (index > -1) {
                this.questions.splice(index, 1);
            }
        },
        loadQuestionForEdit(question) {
            this.editing = true;
            this.editingQuestionId = question.id;
            this.newQuestion.question_text = question.question_text;
            this.newQuestion.question_rank = question.question_rank;
            this.showModal = true;
        },
        addOption() {
            this.newQuestion.options.push({ text: '',next_question_id:'', recommendation: '' });
        },
        async submitQuestion() {
            if (this.editing) {
                await this.$inertia.put(`/questions/${this.editingQuestionId}`, this.newQuestion, {
                    onSuccess: (data) => {
                        this.newQuestion = {
                            question_text: '',
                            question_rank: '',
                            options: [{ text: '',next_question_id:'', recommendation: '' }]
                        };
                        this.error = data.props.flash.error || null;
                        this.message = data.props.flash.message || null;
                    },
                    onError: (data) => {
                        console.log(data);
                    }
                });
            } else {
                await this.$inertia.post('/questions', this.newQuestion, {
                    onSuccess: (data) => {
                        this.newQuestion = {
                            question_text: '',
                            question_rank: '',
                            options: [{ text: '',next_question_id:'', recommendation: '' }]
                        };
                        this.error = data.props.flash.error || null;
                        this.message = data.props.flash.message || null;
                    },
                    onError: (data) => {
                        console.log(data);
                    }
                });
            }
            this.showModal = false;
            this.editing = false;
            this.editingQuestionId = null;
            this.showModal = false;
        }
    },
    data() {
        return {
            currentExpandedQuestion: null,
            editing: false,
            editingQuestionId: null,
            showModal: false,
            newQuestion: {
                question_text: '',
                question_rank: '',
                options: [{ text: '', next_question_id:'',recommendation: ''  }]
            },
            message: null,
            error: null

        };
    }
}
</script>


<template>
    <div class="mb-36">
        <button @click="showModal = true" class="float-right bg-black hover:bg-black text-white py-2 px-4 rounded">Create Question</button>
    </div>
    <!-- Display success message -->
    <div v-if="message" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">{{ message }}</span>
    </div>

    <!-- Display error message -->
    <div v-if="error" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">{{ error }}</span>
    </div>
    <table class="min-w-full bg-white">
        <thead>
        <tr>
            <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-black-500 tracking-wider">Question ID</th>
            <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-black-500 tracking-wider">Question Text</th>
            <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-black-500 tracking-wider">Rank</th>
            <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-black-500 tracking-wider">Actions</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="question in questions" :key="question.id" :class="{ 'bg-blue-200': question.showOptions }" >
            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">{{ question.id }}</td>
            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">{{ question.question_text }}</td>
            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">{{ question.question_rank }}</td>
            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 cursor-pointer">
                <ChevronDownIcon
                    v-if="!question.showOptions"
                    @click="toggleOptions(question)"
                    class="h-5 w-5 inline-block cursor-pointer"
                />
                <ChevronUpIcon
                    v-else
                    @click="toggleOptions(question)"
                    class="h-5 w-5 cursor-pointer"
                />
                <TrashIcon
                    class="ml-10  h-5 w-5 inline-block text-red-500 cursor-pointer"
                    @click.stop="deleteQuestion(question)"
                />
                <PencilIcon
                    class="ml-10  h-5 w-5 inline-block text-blue-500 cursor-pointer"
                    @click.stop="loadQuestionForEdit(question)"
                />
            </td>
        </tr>
        <tr v-for="question in questions" :key="'options-' + question.id">
            <td colspan="4" v-if="question.showOptions" class="px-6 py-4 border-b border-gray-500">
                <table class="w-full bg-gray-700 text-white">
                    <thead>
                    <tr>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 tracking-wider">Option Text</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 tracking-wider">Next Question ID</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 tracking-wider">Recommendation</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="option in question.options" :key="option.id">
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">{{ option.option_text }}</td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">{{ option.next_question_id }}</td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">{{ option.recommendation_allowed === 1 ? option.recommendation.map(rec => rec.product_id).join(', ') : '' }}</td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>

    <!-- Modal -->
    <div v-if="showModal" class="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-white p-6 rounded-lg shadow-md w-1/2">
            <h2 v-if="editing" class="text-2xl mb-6 font-bold">Edit Question</h2>
            <h2 v-else class="text-2xl mb-6 font-bold">Create Question</h2>

            <!-- Question Input -->
            <div class="mb-4">
                <label class="block text-sm font-bold mb-2" for="question-text">Question Text:</label>
                <input v-model="newQuestion.question_text" id="question-text" type="text" placeholder="Enter question text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-bold mb-2" for="question-text">Question Rank:</label>
                <input v-model="newQuestion.question_rank" id="question-text" type="number" placeholder="Enter question rank" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <!-- Options Inputs Only For Creation -->
            <div v-if="editing">
                <!-- Buttons -->
                <div class="flex space-x-4">
                    <button @click="submitQuestion" class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded">Update</button>
                    <button @click="showModal = false" class="bg-red-500 hover:bg-red-700 text-white py-2 px-4 rounded">Close</button>
                </div>
            </div>
            <div v-else>
                <div v-for="(option, index) in newQuestion.options" :key="index" class="mb-4">
                    <div class="flex space-x-2">
                        <div class="flex-1">
                            <label class="block text-sm font-bold mb-1" :for="'option-text-' + index">Option Text:</label>
                            <input v-model="option.text" :id="'option-text-' + index" placeholder="Option text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div class="w-30">
                            <label class="block text-sm font-bold mb-1" :for="'next-question-id-' + index">Next Q ID (Optional):</label>
                            <input v-model="option.next_question_id" :id="'next-question-id-' + index" placeholder="Next Q ID" type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div class="flex-1">
                            <label class="block text-sm font-bold mb-1" :for="'recommendation-' + index">Recommendation (Optional):</label>
                            <input v-model="option.recommendation" :id="'recommendation-' + index" placeholder="Product ID" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                    </div>
                </div>
                <!-- Buttons -->
                <div class="flex space-x-4">
                    <button @click="addOption" class="bg-gray-200 hover:bg-gray-300 py-2 px-4 rounded">Add Option</button>
                    <button @click="submitQuestion" class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded">Submit</button>
                    <button @click="showModal = false" class="bg-red-500 hover:bg-red-700 text-white py-2 px-4 rounded">Close</button>
                </div>
            </div>



        </div>
    </div>
</template>


