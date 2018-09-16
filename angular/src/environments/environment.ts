// The file contents for the current environment will overwrite these during build.
// The build system defaults to the dev environment which uses `environment.ts`, but if you do
// `ng build --env=prod` then `environment.prod.ts` will be used instead.
// The list of which env maps to which file can be found in `.angular-cli.json`.

export const environment = {
  production: false,
  SwappitAuthApi: {
    clientSecret: 'mtbBzErxnxDEemJhRrYjzV4ra4IB9ytMxYoOjBrI',
    url:'http://localhost:8000/',
    endPoints: {
      'oauth/token': 'oauth/token',
      'signup': 'signup',
    }
  },
  SwappitApi: {
    url: 'http://localhost:8000/api/',
    endPoints: {
      'festivals': 'festivals',
      'tickets': 'tickets',
      'orders': 'orders',
      'account': 'account',
      'accountTickets': 'account/tickets',
      'ticket_types': 'ticket_types',
      'vm_festivals': 'vm_festivals',
      'vm_ticket_types': 'vm_ticket_types',
      'vm_ticket_types_info': 'vm_ticket_types_info',
      'tickets/toggle_published':'tickets/toggle_published',
      'indexAvailableAndSold': 'tickets/availableandsold',
      'payOrder': 'orders/pay',
      'bumpTicket': 'tickets/bump'
    }
  }
};
