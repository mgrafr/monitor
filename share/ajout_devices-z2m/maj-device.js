 {
 fingerprint: tuya.fingerprint("TS0601", ["_TZE200_npj9bug3"]),
        model: "TS0601-soil1",
        icon: '/icons/tuya_soil1.png',
        vendor: "Tuya",
        description: "Soil sensor",
        fromZigbee: [tuya.fz.datapoints],
        toZigbee: [tuya.tz.datapoints],
        configure: tuya.configureMagicPacket,
        exposes: [e.temperature(), e.soil_moisture(), tuya.exposes.temperatureUnit(), e.battery(), tuya.exposes.batteryState()],
        meta: {
            tuyaDatapoints: [
                [3, "soil_moisture", tuya.valueConverter.raw],
                [5, "temperature", tuya.valueConverter.divideBy10.raw],
                [9, "temperature_unit", tuya.valueConverter.temperatureUnit],
                [14, "battery_state", tuya.valueConverter.batteryState],
                [15, "battery", tuya.valueConverter.raw],
            ],
        },
    },


       ////////////////////////
    // TS0002 DEFINITIONS //
    ////////////////////////
    {
        // TS0002 model with only on/off capability
        fingerprint: tuya.fingerprint("TS0002", [
            "_TZ3000_01gpyda5",
            "_TZ3000_bvrlqyj7",
            "_TZ3000_7ed9cqgi",
            "_TZ3000_zmy4lslw",
            "_TZ3000_ruxexjfz",
            "_TZ3000_4xfqlgqo",
            "_TZ3000_hojntt34",
            "_TZ3000_eei0ubpy",
            "_TZ3000_qaa59zqd",
            "_TZ3000_lmlsduws",
            "_TZ3000_lugaswf8",
            "_TZ3000_fbjdkph9",
            "_TZ3000_uim07oem",
        ]),
        model: "TS0002_basic",
        vendor: "Tuya",
        description: "2 gang switch module",
        whiteLabel: [
            { vendor: "OXT", model: "SWTZ22" },
            { vendor: "Moes", model: "ZM-104B-M" },
            tuya.whitelabel("pcblab.io", "RR620ZB", "2 gang Zigbee switch module", ["_TZ3000_4xfqlgqo"]),
            tuya.whitelabel("Nous", "L13Z", "2 gang switch", ["_TZ3000_ruxexjfz", "_TZ3000_hojntt34"]),
            tuya.whitelabel("Tuya", "ZG-2002-RF", "Three mode Zigbee Switch", ["_TZ3000_lugaswf8"]),
            tuya.whitelabel("Mercator Ikuü", "SSW02", "2 gang switch", ["_TZ3000_fbjdkph9"]),
        ],
        extend: [
            tuya.modernExtend.tuyaOnOff({
                switchType: true,
                endpoints: ["l1", "l2"],
            }),
        ],
        endpoint: (device) => {
            return { l1: 1, l2: 2 };
        },
        meta: { multiEndpoint: true },
        configure: async (device, coordinatorEndpoint) => {
            await tuya.configureMagicPacket(device, coordinatorEndpoint);
            await reporting.bind(device.getEndpoint(1), coordinatorEndpoint, ["genOnOff"]);
            await reporting.bind(device.getEndpoint(2), coordinatorEndpoint, ["genOnOff"]);
        },
    },