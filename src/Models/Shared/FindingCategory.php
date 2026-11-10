<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** What a finding is about: a direct threat to the principal or the event, intent to harm without a named target, fixation on the principal, a grievance against the host, research into the venue, route or security, weapons tied to any of these, disruption or protest planning toward this event, violent extremist content or identification, prior harassment or stalking of staff or principals, or posting the principal's addresses or movements. */
enum FindingCategory: string
{
    case DirectThreat = 'direct_threat';
    case HarmIntent = 'harm_intent';
    case Fixation = 'fixation';
    case Grievance = 'grievance';
    case SecurityResearch = 'security_research';
    case Weapons = 'weapons';
    case Disruption = 'disruption';
    case ViolentExtremism = 'violent_extremism';
    case Harassment = 'harassment';
    case MovementExposure = 'movement_exposure';
}
