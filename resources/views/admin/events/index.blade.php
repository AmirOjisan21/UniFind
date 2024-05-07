<x-app-layout>
    <x-slot name="events">
      <h2>
        {{ __('Events') }}
      </h2>
    </x-slot>
  
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg justify-center">
          <div class="p-6 text-gray-900 justify-center">
          </div>
          {{-- @php
            $cevents = $events;
          @endphp --}}
          @include('admin.events.callender')
        </div>
      </div>
    </div>
    <div class="py-2 font-mono">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900 justify-center">
            <div class="mb-3">
              <div class="float-left pb-2">
                  <a href="{{ route('events.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">{{ __('Add Event') }}</a>
                  <h1 class="text-2xl font-semibold">{{ __('List') }} <small>{{ __('Total') }} : {{ count($events) }} {{ __('Upcoming Events') }}</small></h1>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
                <table class="min-w-full divide-y divide-gray-200">
                  <thead class="bg-gray-50">
                      <tr>
                          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('No') }}</th>
                          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Name') }}</th>
                          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Image') }}</th>
                          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Description') }}</th>
                          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Start Time') }}</th>
                          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('End Time') }}</th>
                          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Action') }}</th>
                      </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                      @foreach($events as $key => $event)
                      <tr>
                          <td class="px-6 py-4 whitespace-nowrap">{{ $key + 1 }}</td>
                          <td class="px-6 py-4 whitespace-nowrap">{!! $event->name !!}</td>
                          <td class="px-6 py-4 whitespace-nowrap">
                              @if($event->image)
                              <img src="{{ asset('/images/' . $event->image) }}" alt="{{ $event->name }}" class="w-10 h-10 rounded-md object-cover">
                              @endif
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">{{ $event->description }}</td>
                          <td class="px-6 py-4 whitespace-nowrap">{{ $event->start_date }}</td>
                          <td class="px-6 py-4 whitespace-nowrap">{{ $event->end_date }}</td>
                          <td class="px-6 py-4 whitespace-nowrap">
                              <a class="font-bold text-blue-600 hover:text-blue-900" href="{{ route('events.show', $event) }}" id="show-event-{{ $event->id }}">{{ __('Show') }}</a>
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
  