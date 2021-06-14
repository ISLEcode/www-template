export type ID = number;
export type UUID = string;

export interface OptionSet {
  id: ID;
  name: string;
  description?: string;
}

export interface UOptionSet {
  uuid: UUID;
  name: string;
  description?: string;
}
