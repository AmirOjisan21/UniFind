<x-app-layout>
    <x-slot name="ksajs">
      <h2>
        {{ __('Ksajs') }}
      </h2>
    </x-slot>
  
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg justify-center">
          <div class="p-6 text-gray-900 justify-center">
            @include('admin.ksajs.map')
          </div>
        </div>
      </div>
    </div>
    <div class="py-2 font-mono">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg justify-center">
          <div class="p-6 text-gray-900 justify-center">
            <div class="mb-3">
              <div class="float-left">
                  <a href="{{ route('ksajs.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">{{ __('Add Location') }}</a>
                <h1 class="text-2xl font-semibold">{{ __('List') }} <small>{{ __('Total') }} : {{ count($ksajss) }} {{ __('Current Ksajs Locations') }}</small></h1>
              </div>
            </div>
          
                <table class="min-w-full divide-y divide-gray-200">
                  <thead class="bg-gray-50">
                      <tr>
                          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('No') }}</th>
                          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Name') }}</th>
                          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Image') }}</th>
                          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Description') }}</th>
                          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Open Hours') }}</th>
                          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Important Details') }}</th>
                          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Action') }}</th>
                      </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                      @foreach($ksajss as $key => $ksajs)
                      <tr>
                          <td class="px-6 py-4 whitespace-nowrap">{{ $key + 1 }}</td>
                          <td class="px-6 py-4 whitespace-nowrap">{!! $ksajs->name !!}</td>
                          <td class="px-6 py-4 whitespace-nowrap">
                              @if($ksajs->image)
                              <img src="{{ asset('/images/' . $ksajs->image) }}" alt="{{ $ksajs->name }}" class="w-10 h-10 rounded-md object-cover">
                              @endif
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">{{ $ksajs->description }}</td>
                          <td class="px-6 py-4 whitespace-nowrap">{{ $ksajs->open_hours }}</td>
                          <td class="px-6 py-4 whitespace-nowrap">{{ $ksajs->important_details }}</td>
                          <td class="px-6 py-4 whitespace-nowrap">
                              <a class="font-bold text-blue-600 hover:text-blue-900" href="{{ route('ksajs.show', $ksajs) }}" id="show-ksajs-{{ $ksajs->id }}">{{ __('Show') }}</a>
                          </td>
                      </tr>
                      @endforeach
                  </tbody>
              </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </x-layout-app>
  