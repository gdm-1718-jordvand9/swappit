import { TicketType } from "./ticket-type";

export class Festival {
  id: string;
  name: string;
  place?: string;
  description?: string;
  start_date?: Date;
  end_date?: Date;
  twitter_url?: string;
  facebook_url?: string;
  instagram_url?: string;
  snapchat_url?: string;
  ticket_types: Array<TicketType>;
  tickets_wanted_count: string;
  tickets_available_count: string;
  tickets_sold_count: string;
}