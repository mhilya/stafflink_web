<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employee Promotion Prediction') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form id="predictionForm">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- KPIs Met >80% -->
                            <div>
                                <label for="KPIs_met_more_than_80" class="block text-sm font-medium text-gray-700">
                                    {{ __('KPIs Met >80%') }}
                                </label>
                                <select id="KPIs_met_more_than_80" name="KPIs_met_more_than_80"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="">Select</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>

                            <!-- Average Training Score -->
                            <div>
                                <label for="avg_training_score" class="block text-sm font-medium text-gray-700">
                                    {{ __('Average Training Score') }}
                                </label>
                                <input id="avg_training_score"
                                    class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    type="number" step="0.01" min="0" max="100"
                                    name="avg_training_score" required />
                            </div>

                            <!-- Previous Year Rating -->
                            <div>
                                <label for="previous_year_rating" class="block text-sm font-medium text-gray-700">
                                    {{ __('Previous Year Rating') }}
                                </label>
                                <select id="previous_year_rating" name="previous_year_rating"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="">Select</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>

                            <!-- Awards Won -->
                            <div>
                                <label for="awards_won" class="block text-sm font-medium text-gray-700">
                                    {{ __('Awards Won') }}
                                </label>
                                <select id="awards_won" name="awards_won"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="">Select</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <button type="button" onclick="submitPrediction()"
                                class="ml-3 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                                {{ __('Predict') }}
                            </button>
                        </div>
                    </form>

                    <div id="resultContainer" class="mt-8 hidden">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900">Prediction Result</h3>
                            <div class="mt-4 space-y-4">
                                {{-- <div>
                                    <h4 class="font-medium text-gray-700">Input Values:</h4>
                                    <ul id="featureValues" class="text-gray-600 mt-1 space-y-1"></ul>
                                </div> --}}
                                <div>
                                    <h4 class="font-medium text-gray-700">Prediction:</h4>
                                    <p id="predictionResult" class="text-xl font-semibold mt-1"></p>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-700">Probability:</h4>
                                    <p id="probabilityResult" class="text-gray-600 mt-1"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function submitPrediction() {
            const form = document.getElementById('predictionForm');
            const formData = new FormData(form);
            const resultContainer = document.getElementById('resultContainer');
            const predictionResult = document.getElementById('predictionResult');
            const probabilityResult = document.getElementById('probabilityResult');
            // const featureValuesList = document.getElementById('featureValues');

            // Show loading state
            resultContainer.classList.add('hidden');
            predictionResult.textContent = '';
            probabilityResult.textContent = '';
            // featureValuesList.innerHTML = '';

            fetch("{{ route('predictions.predict') }}", {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        // Display feature values
                        const features = data.feature_values;
                        for (const [key, value] of Object.entries(features)) {
                            const listItem = document.createElement('li');
                            listItem.textContent = `${key}: ${value}`;
                            // featureValuesList.appendChild(listItem);
                        }

                        // Display prediction result
                        const promoted = data.prediction === 'promoted';
                        predictionResult.textContent = promoted ? 'Promoted' : 'Not Promoted';
                        predictionResult.className =
                            `text-xl font-semibold mt-1 ${promoted ? 'text-green-600' : 'text-red-600'}`;

                        // Display probability
                        probabilityResult.textContent = data.probability;

                        // Show the result container
                        resultContainer.classList.remove('hidden');
                    } else {
                        alert('Prediction failed: ' + (data.message || 'Unknown error'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while making the prediction');
                });
        }
    </script>
</x-app-layout>
